<?php

/**
 * @package     <%=s.classify(data.projectName)%>
 * @subpackage
 *
 * @copyright
 * @license
 */
defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Framework.
 *
 * @since  1.6
 */
class JFormField<%=s.classify(data.projectName)%> extends JFormFieldList{

  /**
   * The form field type.
   *
   * @var        string
   * @since   1.6
   */
  protected $type='<%=s.classify(data.projectName)%>';

  public function getLabel() {
		return parent::getLabel();
	}

  /**
   * Method to get the field options.
   *
   * @return  array  The field option objects.
   *
   * @since   1.6
   */
  protected function getOptions(){
    $options=array();

    $db=JFactory::getDbo();
    $query=$db->getQuery(true)
      ->select('a.<%=data.fieldValue%> AS value, a.<%=data.fieldText%> AS text')
      ->from('#__<%=data.tableName%> AS a');

    <% if(data.customWhere){ %>$query->where('<%=data.customWhere%>');<% } %>

    // Get the options.
    $db->setQuery($query);

    try{
      $options=$db->loadObjectList();
    } catch(RuntimeException $e){
      JError::raiseWarning(500,$e->getMessage());
    }

    // Merge any additional options in the XML definition.
    $options=array_merge(parent::getOptions(),$options);

    $returnOptions = array();

		foreach ($options as $option){
		    $returnOptions[] = JHtml::_('select.option', $option->value, $option->text);
		}

		return $returnOptions;
  }

}
