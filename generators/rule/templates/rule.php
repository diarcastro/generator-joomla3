<?php

/**
 * @package
 * @subpackage
 *
 * @copyright
 * @license
 */
defined('_JEXEC') or die;

use Joomla\Registry\Registry;

JFormHelper::loadRuleClass('<%=data.projectType.lCase()%>');

/**
 * JFormRule<%=s.classify(data.projectName)%> to validate <%=data.projectType.lCase()%> form value.
 *
 * @since  1.6
 */
class JFormRule<%=s.classify(data.projectName)%> extends JFormRule<%=s.capitalize(data.projectType)%>{

  /**
   * Method to test for extra validation
   *
   * @param   SimpleXMLElement  $element  The SimpleXMLElement object representing the <field /> tag for the form field object.
   * @param   mixed             $value    The form field value to validate.
   * @param   string            $group    The field name group control value. This acts as as an array container for the field.
   *                                      For example if the field has name="foo" and the group value is set to "bar" then the
   *                                      full field name would end up being "bar[foo]".
   * @param   Registry          $input    An optional Registry object with the entire data set to validate against the entire form.
   * @param   JForm             $form     The form object for which the field is being tested.
   *
   * @return  boolean  True if the value is valid, false otherwise.
   */
  public function test(SimpleXMLElement $element,$value,$group=null,Registry $input=null,JForm $form=null){
    return parent::test($element,$value,$group,$input,$form);
  }

}
