import argparse
import sys
import MySQLdb
import MySQLdb.cursors
import logging

db			= MySQLdb.connect( host="127.0.0.1", port=3306, user="root",
                                           passwd="root", db="watchman",
                                           cursorclass=MySQLdb.cursors.DictCursor  )

conn			= db.cursor()

def split_data():
    get_query		= """select * from chronicle"""
    conn.execute( get_query )

    query		= conn.fetchall()
    
    for data in query:
        data_split		= data['full_text'].split('<hr id="system-readmore" />', 1)
        chron_id  		= int( data['id'] )
        title			= data['title']
        intro			= data_split[ 0 ]
        try:
            # Update the 'intro_text'
            update_intro	= """update chronicle set `intro_text` = %s where id = '%s' """
            conn.execute( update_intro, ( intro, chron_id ))
            db.commit()

            # Remove the <hr> from the 'full_text'
            new_ftext		= ''.join( data_split )
            print new_ftext
            update_full		= """update chronicle set `full_text` = %s where id = '%s' """
            conn.execute( update_full, ( new_ftext, chron_id ))
            db.commit()
            
        except MySQLdb.IntegrityError:
            logging.warn("failed to update values %d, %s", chronicle_id, title )

split_data()
