<?php
/**
 * MUSeo.
 *
 * @copyright Michael Ueberschaer (MU)
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @package MUSeo
 * @author Michael Ueberschaer <kontakt@webdesign-in-bremen.com>.
 * @link http://webdesign-in-bremen.com
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.7.0 (http://modulestudio.de).
 */

/**
 * Utility base class for list field entries related methods.
 */
class MUSeo_Util_Base_ListEntries extends Zikula_AbstractBase
{
    /**
     * Return the name or names for a given list item.
     *
     * @param string $value      The dropdown value to process.
     * @param string $objectType The treated object type.
     * @param string $fieldName  The list field's name.
     * @param string $delimiter  String used as separator for multiple selections.
     *
     * @return string List item name.
     */
    public function resolve($value, $objectType = '', $fieldName = '', $delimiter = ', ')
    {
        if (empty($value) || empty($objectType) || empty($fieldName)) {
            return $value;
        }
    
        $isMulti = $this->hasMultipleSelection($objectType, $fieldName);
        if ($isMulti === true) {
            $value = $this->extractMultiList($value);
        }
    
        $options = $this->getEntries($objectType, $fieldName);
        $result = '';
    
        if ($isMulti === true) {
            foreach ($options as $option) {
                if (!in_array($option['value'], $value)) {
                    continue;
                }
                if (!empty($result)) {
                    $result .= $delimiter;
                }
                $result .= $option['text'];
            }
        } else {
            foreach ($options as $option) {
                if ($option['value'] != $value) {
                    continue;
                }
                $result = $option['text'];
                break;
            }
        }
    
        return $result;
    }
    

    /**
     * Extract concatenated multi selection.
     *
     * @param string  $value The dropdown value to process.
     *
     * @return array List of single values.
     */
    public function extractMultiList($value)
    {
        $listValues = explode('###', $value);
        $amountOfValues = count($listValues);
        if ($amountOfValues > 1 && $listValues[$amountOfValues - 1] == '') {
            unset($listValues[$amountOfValues - 1]);
        }
        if ($listValues[0] == '') {
            // use array_shift instead of unset for proper key reindexing
            // keys must start with 0, otherwise the dropdownlist form plugin gets confused
            array_shift($listValues);
        }
    
        return $listValues;
    }
    

    /**
     * Determine whether a certain dropdown field has a multi selection or not.
     *
     * @param string $objectType The treated object type.
     * @param string $fieldName  The list field's name.
     *
     * @return boolean True if this is a multi list false otherwise.
     */
    public function hasMultipleSelection($objectType, $fieldName)
    {
        if (empty($objectType) || empty($fieldName)) {
            return false;
        }
    
        $result = false;
        switch ($objectType) {
            case 'metatag':
                switch ($fieldName) {
                    case 'workflowState':
                        $result = false;
                        break;
                    case 'robotsIndex':
                        $result = false;
                        break;
                    case 'robotsFollow':
                        $result = false;
                        break;
                    case 'robotsAdvanced':
                        $result = true;
                        break;
                }
                break;
            case 'extension':
                switch ($fieldName) {
                    case 'workflowState':
                        $result = false;
                        break;
                }
                break;
        }
    
        return $result;
    }
    

    /**
     * Get entries for a certain dropdown field.
     *
     * @param string  $objectType The treated object type.
     * @param string  $fieldName  The list field's name.
     *
     * @return array Array with desired list entries.
     */
    public function getEntries($objectType, $fieldName)
    {
        if (empty($objectType) || empty($fieldName)) {
            return array();
        }
    
        $entries = array();
        switch ($objectType) {
            case 'metatag':
                switch ($fieldName) {
                    case 'workflowState':
                        $entries = $this->getWorkflowStateEntriesForMetatag();
                        break;
                    case 'robotsIndex':
                        $entries = $this->getRobotsIndexEntriesForMetatag();
                        break;
                    case 'robotsFollow':
                        $entries = $this->getRobotsFollowEntriesForMetatag();
                        break;
                    case 'robotsAdvanced':
                        $entries = $this->getRobotsAdvancedEntriesForMetatag();
                        break;
                }
                break;
            case 'extension':
                switch ($fieldName) {
                    case 'workflowState':
                        $entries = $this->getWorkflowStateEntriesForExtension();
                        break;
                }
                break;
        }
    
        return $entries;
    }

    
    /**
     * Get 'workflow state' list entries.
     *
     * @return array Array with desired list entries.
     */
    public function getWorkflowStateEntriesForMetatag()
    {
        $states = array();
        $states[] = array('value'   => 'approved',
                          'text'    => $this->__('Approved'),
                          'title'   => $this->__('Content has been approved and is available online.'),
                          'image'   => '',
                          'default' => false);
        $states[] = array('value'   => '!approved',
                          'text'    => $this->__('All except approved'),
                          'title'   => $this->__('Shows all items except these which are approved'),
                          'image'   => '',
                          'default' => false);
    
        return $states;
    }
    
    /**
     * Get 'robots index' list entries.
     *
     * @return array Array with desired list entries.
     */
    public function getRobotsIndexEntriesForMetatag()
    {
        $states = array();
        $states[] = array('value'   => '',
                          'text'    => $this->__('Default'),
                          'title'   => '',
                          'image'   => '',
                          'default' => true);
        $states[] = array('value'   => 'index',
                          'text'    => $this->__('Index'),
                          'title'   => '',
                          'image'   => '',
                          'default' => false);
        $states[] = array('value'   => 'noindex',
                          'text'    => $this->__('No index'),
                          'title'   => '',
                          'image'   => '',
                          'default' => false);
    
        return $states;
    }
    
    /**
     * Get 'robots follow' list entries.
     *
     * @return array Array with desired list entries.
     */
    public function getRobotsFollowEntriesForMetatag()
    {
        $states = array();
        $states[] = array('value'   => '',
                          'text'    => $this->__('Default'),
                          'title'   => '',
                          'image'   => '',
                          'default' => true);
        $states[] = array('value'   => 'follow',
                          'text'    => $this->__('Follow'),
                          'title'   => '',
                          'image'   => '',
                          'default' => false);
        $states[] = array('value'   => 'nofollow',
                          'text'    => $this->__('Nofollow'),
                          'title'   => '',
                          'image'   => '',
                          'default' => false);
    
        return $states;
    }
    
    /**
     * Get 'robots advanced' list entries.
     *
     * @return array Array with desired list entries.
     */
    public function getRobotsAdvancedEntriesForMetatag()
    {
        $states = array();
        $states[] = array('value'   => '-',
                          'text'    => $this->__('Default'),
                          'title'   => '',
                          'image'   => '',
                          'default' => true);
        $states[] = array('value'   => 'none',
                          'text'    => $this->__('None'),
                          'title'   => '',
                          'image'   => '',
                          'default' => false);
        $states[] = array('value'   => 'noodp',
                          'text'    => $this->__('No o d p'),
                          'title'   => '',
                          'image'   => '',
                          'default' => false);
        $states[] = array('value'   => 'noydir',
                          'text'    => $this->__('No y d i r'),
                          'title'   => '',
                          'image'   => '',
                          'default' => false);
        $states[] = array('value'   => 'noimageindex',
                          'text'    => $this->__('No image index'),
                          'title'   => '',
                          'image'   => '',
                          'default' => false);
        $states[] = array('value'   => 'noarchive',
                          'text'    => $this->__('No archive'),
                          'title'   => '',
                          'image'   => '',
                          'default' => false);
        $states[] = array('value'   => 'nosnippet',
                          'text'    => $this->__('No snippet'),
                          'title'   => '',
                          'image'   => '',
                          'default' => false);
    
        return $states;
    }
    
    /**
     * Get 'workflow state' list entries.
     *
     * @return array Array with desired list entries.
     */
    public function getWorkflowStateEntriesForExtension()
    {
        $states = array();
        $states[] = array('value'   => 'approved',
                          'text'    => $this->__('Approved'),
                          'title'   => $this->__('Content has been approved and is available online.'),
                          'image'   => '',
                          'default' => false);
        $states[] = array('value'   => '!approved',
                          'text'    => $this->__('All except approved'),
                          'title'   => $this->__('Shows all items except these which are approved'),
                          'image'   => '',
                          'default' => false);
    
        return $states;
    }
}
