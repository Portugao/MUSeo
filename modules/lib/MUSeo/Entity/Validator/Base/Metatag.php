<?php
/**
 * MUSeo.
 *
 * @copyright Michael ueberschaer
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @package MUSeo
 * @author Michael ueberschaer <konakt@webdesign-in-bremen.com>.
 * @link http://webdesign-in-bremen.com
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.5.4 (http://modulestudio.de) at Tue Nov 20 20:20:03 CET 2012.
 */

/**
 * Validator class for encapsulating entity validation methods.
 *
 * This is the base validation class for metatag entities.
 */
class MUSeo_Entity_Validator_Base_Metatag extends MUSeo_Validator
{

    /**
     * Performs all validation rules.
     *
     * @return mixed either array with error information or true on success
     */
    public function validateAll()
    {
        $errorInfo = array('message' => '', 'code' => 0, 'debugArray' => array());
        $dom = ZLanguage::getModuleDomain('MUSeo');
        if (!$this->isValidInteger('id')) {
            $errorInfo['message'] = __f('Error! Field value may only contain digits (%s).', array('id'), $dom);
            return $errorInfo;
        }
        if (!$this->isNumberNotLongerThan('id', 9)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('id', 9), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('titleOfEntity', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('titleOfEntity', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotEmpty('titleOfEntity')) {
            $errorInfo['message'] = __f('Error! Field value must not be empty (%s).', array('titleOfEntity'), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('title', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('title', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotEmpty('title')) {
            $errorInfo['message'] = __f('Error! Field value must not be empty (%s).', array('title'), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('description', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('description', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('keywords', 255)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('keywords', 255), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('theModule', 50)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('theModule', 50), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotEmpty('theModule')) {
            $errorInfo['message'] = __f('Error! Field value must not be empty (%s).', array('theModule'), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('functionOfModule', 50)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('functionOfModule', 50), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotEmpty('functionOfModule')) {
            $errorInfo['message'] = __f('Error! Field value must not be empty (%s).', array('functionOfModule'), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('objectOfModule', 50)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('objectOfModule', 50), $dom);
            return $errorInfo;
        }
        if (!$this->isStringNotLongerThan('nameOfIdentifier', 20)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('nameOfIdentifier', 20), $dom);
            return $errorInfo;
        }
        if (!$this->isValidInteger('idOfObject')) {
            $errorInfo['message'] = __f('Error! Field value may only contain digits (%s).', array('idOfObject'), $dom);
            return $errorInfo;
        }
        if (!$this->isNumberNotLongerThan('idOfObject', 11)) {
            $errorInfo['message'] = __f('Error! Length of field value must not be higher than %2$s (%1$s).', array('idOfObject', 11), $dom);
            return $errorInfo;
        }
        return true;
    }

    /**
     * Check for unique values.
     *
     * This method determines if there already exist metatags with the same metatag.
     *
     * @param string $fieldName The name of the property to be checked
     * @return boolean result of this check, true if the given metatag does not already exist
     */
    public function isUniqueValue($fieldName)
    {
        if (empty($this->entity[$fieldName])) {
            return false;
        }

        $serviceManager = ServiceUtil::getManager();
        $entityManager = $serviceManager->getService('doctrine.entitymanager');
        $repository = $entityManager->getRepository('MUSeo_Entity_Metatag');

        $excludeid = $this->entity['id'];
        return $repository->detectUniqueState($fieldName, $this->entity[$fieldName], $excludeid);
    }

    /**
     * Get entity.
     *
     * @return Zikula_EntityAccess
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set entity.
     *
     * @param Zikula_EntityAccess $entity.
     *
     * @return void
     */
    public function setEntity(Zikula_EntityAccess $entity = null)
    {
        $this->entity = $entity;
    }

}
