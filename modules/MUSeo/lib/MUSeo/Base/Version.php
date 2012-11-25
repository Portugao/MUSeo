<?php
/**
 * MUSeo.
 *
 * @copyright Michael Ueberschaer
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 * @package MUSeo
 * @author Michael Ueberschaer <kontakt@webdesign-in-bremen.com>.
 * @link http://webdesign-in-bremen.com
 * @link http://zikula.org
 * @version Generated by ModuleStudio 0.5.4 (http://modulestudio.de) at Sun Nov 25 15:03:25 CET 2012.
 */

/**
 * Version information base class.
 */
class MUSeo_Base_Version extends Zikula_AbstractVersion
{
    public function getMetaData()
    {
        $meta = array();
        // the current module version
        $meta['version']              = '1.0.0';
        // the displayed name of the module
        $meta['displayname']          = $this->__('MUSeo');
        // the module description
        $meta['description']          = $this->__('MUSeo module generated by ModuleStudio 0.5.4.');
        //! url version of name, should be in lowercase without space
        $meta['url']                  = $this->__('museo');
        // core requirement
        $meta['core_min']             = '1.3.1'; // requires minimum 1.3.1 or later
        $meta['core_max']             = '1.3.99'; // not ready for 1.4.0 yet

        // define special capabilities of this module
        $meta['capabilities'] = array(
                          HookUtil::SUBSCRIBER_CAPABLE => array('enabled' => true)
/*,
                          HookUtil::PROVIDER_CAPABLE => array('enabled' => true), // TODO: see #15
                          'authentication' => array('version' => '1.0'),
                          'profile'        => array('version' => '1.0', 'anotherkey' => 'anothervalue'),
                          'message'        => array('version' => '1.0', 'anotherkey' => 'anothervalue')
*/
        );

        // permission schema
        // DEBUG: permission schema aspect starts
        $meta['securityschema'] = array(
            'MUSeo::' => '::',

            'MUSeo:Metatag:' => 'MetatagID::',
            'MUSeo:Module:' => 'ModuleID::'
        );
        // DEBUG: permission schema aspect ends



        return $meta;
    }

    /**
     * Define hook subscriber bundles.
     */
    protected function setupHookBundles()
    {

        $bundle = new Zikula_HookManager_SubscriberBundle($this->name, 'subscriber.museo.ui_hooks.metatags', 'ui_hooks', __('museo Metatags Display Hooks'));
        // Display hook for view/display templates.
        $bundle->addEvent('display_view', 'museo.ui_hooks.metatags.display_view');
        // Display hook for create/edit forms.
        $bundle->addEvent('form_edit', 'museo.ui_hooks.metatags.form_edit');
        // Display hook for delete dialogues.
        $bundle->addEvent('form_delete', 'museo.ui_hooks.metatags.form_delete');
        // Validate input from an ui create/edit form.
        $bundle->addEvent('validate_edit', 'museo.ui_hooks.metatags.validate_edit');
        // Validate input from an ui create/edit form (generally not used).
        $bundle->addEvent('validate_delete', 'museo.ui_hooks.metatags.validate_delete');
        // Perform the final update actions for a ui create/edit form.
        $bundle->addEvent('process_edit', 'museo.ui_hooks.metatags.process_edit');
        // Perform the final delete actions for a ui form.
        $bundle->addEvent('process_delete', 'museo.ui_hooks.metatags.process_delete');
        $this->registerHookSubscriberBundle($bundle);

        $bundle = new Zikula_HookManager_SubscriberBundle($this->name, 'subscriber.museo.filter_hooks.metatags', 'filter_hooks', __('museo Metatags Filter Hooks'));
        // A filter applied to the given area.
        $bundle->addEvent('filter', 'museo.filter_hooks.metatags.filter');
        $this->registerHookSubscriberBundle($bundle);

        $bundle = new Zikula_HookManager_SubscriberBundle($this->name, 'subscriber.museo.ui_hooks.modules', 'ui_hooks', __('museo Modules Display Hooks'));
        // Display hook for view/display templates.
        $bundle->addEvent('display_view', 'museo.ui_hooks.modules.display_view');
        // Display hook for create/edit forms.
        $bundle->addEvent('form_edit', 'museo.ui_hooks.modules.form_edit');
        // Display hook for delete dialogues.
        $bundle->addEvent('form_delete', 'museo.ui_hooks.modules.form_delete');
        // Validate input from an ui create/edit form.
        $bundle->addEvent('validate_edit', 'museo.ui_hooks.modules.validate_edit');
        // Validate input from an ui create/edit form (generally not used).
        $bundle->addEvent('validate_delete', 'museo.ui_hooks.modules.validate_delete');
        // Perform the final update actions for a ui create/edit form.
        $bundle->addEvent('process_edit', 'museo.ui_hooks.modules.process_edit');
        // Perform the final delete actions for a ui form.
        $bundle->addEvent('process_delete', 'museo.ui_hooks.modules.process_delete');
        $this->registerHookSubscriberBundle($bundle);

        $bundle = new Zikula_HookManager_SubscriberBundle($this->name, 'subscriber.museo.filter_hooks.modules', 'filter_hooks', __('museo Modules Filter Hooks'));
        // A filter applied to the given area.
        $bundle->addEvent('filter', 'museo.filter_hooks.modules.filter');
        $this->registerHookSubscriberBundle($bundle);


    }
}

