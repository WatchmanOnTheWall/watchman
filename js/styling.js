function findMaxHeight(selector) {
  var mh = 0
  $j(selector).each(function() {
    var h = $j(this).height()
      if(h>mh) {
	mh = h
      }
  })
  return mh
}
function setDivider(measure,setter) {
  var mh = findMaxHeight(measure)
  $j(setter).height(mh+'px')
  $j(setter+' .line').height((mh-80)+'px')
}
$j(document).ready(function() {
  setDivider('#content_bottom .col','#content_bottom .divider')

  $j('.container_top .top_menu ul.menu').addClass('js-menu')
  $j('.container_top .top_menu ul.menu > li').each(function() {
    $j(this).mouseenter(function() {
//      $j(this).children('ul').stop(true,true).fadeIn(500)
      $j(this).children('ul').stop(true,true).slideDown(200)
    })
    $j(this).mouseleave(function() {
//      $j(this).children('ul').stop(true,true).fadeOut(500)
      $j(this).children('ul').stop(true,true).slideUp(300)
    })
  })
/*
  $j('body,.container_top .header,.container_middle .content, #content_bottom, .container_top .top_menu').hide()
  $j('body').fadeIn(1000)
  $j('.container_top .header').fadeIn(2000)
  $j('.container_middle .content').delay(800).fadeIn(2000)
  $j('#content_bottom').delay(800).fadeIn(1000)
  $j('.container_top .top_menu').delay(1600).fadeIn(1000)
*/
})
