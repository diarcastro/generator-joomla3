<?php

/**
 * @package     Joomla.Site
 * @subpackage  <%=componentName%>
 *
 * @license     <%=license%>
 */
defined('_JEXEC') or die;

/**
 * Routing class from <%=componentName%>
 *
 * @since  3.3
 */
class <%=s.capitalize(projectName)%>Router extends JComponentRouterBase{

  /**
   * Build the route for the <%=componentName%> component
   *
   * @param   array  &$query  An array of URL arguments
   *
   * @return  array  The URL arguments to use to assemble the subsequent URL.
   *
   * @since   3.3
   */
  public function build(&$query){
    $segments=array();

    if(isset($query['task'])){
      $segments[]=$query['task'];
      unset($query['task']);
    }

    if(isset($query['id'])){
      $segments[]=$query['id'];
      unset($query['id']);
    }

    $total=count($segments);

    for($i=0; $i < $total; $i++){
      $segments[$i]=str_replace(':','-',$segments[$i]);
    }

    return $segments;
  }

  /**
   * Parse the segments of a URL.
   *
   * @param   array  &$segments  The segments of the URL to parse.
   *
   * @return  array  The URL attributes to be used by the application.
   *
   * @since   3.3
   */
  public function parse(&$segments){
    $total=count($segments);
    $vars=array();

    for($i=0; $i < $total; $i++){
      $segments[$i]=preg_replace('/-/',':',$segments[$i],1);
    }

    // View is always the first element of the array
    $count=count($segments);

    if($count){
      $count--;
      $segment=array_shift($segments);

      if(is_numeric($segment)){
        $vars['id']=$segment;
      }else{
        $vars['task']=$segment;
      }
    }

    if($count){
      $segment=array_shift($segments);

      if(is_numeric($segment)){
        $vars['id']=$segment;
      }
    }

    return $vars;
  }

}
