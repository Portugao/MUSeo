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
 * @version Generated by ModuleStudio 0.5.4 (http://modulestudio.de) at Sun Nov 18 10:40:42 CET 2012.
 */

/**
 * This handler class handles the page events of the Form called by the MUSeo_admin_edit() function.
 * It aims on the metatag object type.
 */
class MUSeo_Form_Handler_Admin_Metatag_Edit extends MUSeo_Form_Handler_Admin_Metatag_Base_Edit
{
    /**
     * Post-initialise hook.
     *
     * @return void
     */
    public function postInitialize()
    {
    	$modules = MUSeo_Api_HandleModules::checkModules();

		foreach ($modules as $module) {
			$availableModules[] = array('value' => $module, 'text' => $module);
		}

		$metatag = $this->view->get_template_vars('metatag');
		$metatag['theModuleItems'] = $availableModules;
		$this->view->assign('metatag', $metatag);
        parent::postInitialize();
    }
}
