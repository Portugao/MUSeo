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
 * Event handler implementation class for dispatching modules.
 */
class MUSeo_Listener_ModuleDispatch extends MUSeo_Listener_Base_ModuleDispatch
{
    /**
     * Listener for the `module_dispatch.postloadgeneric` event.
     *
     * Called after a module api or controller has been loaded.
     * Receives the args `array('modinfo' => $modinfo, 'type' => $type, 'force' => $force, 'api' => $api)`.
     *
     * @param Zikula_Event $event The event instance.
     */
    public static function postLoadGeneric(Zikula_Event $event)
    {
        parent::postLoadGeneric($event);
    
        // you can access general data available in the event
        
        // the event name
        // echo 'Event: ' . $event->getName();
        
        // type of current request: MASTER_REQUEST or SUB_REQUEST
        // if a listener should only be active for the master request,
        // be sure to check that at the beginning of your method
        // if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
        //     // don't do anything if it's not the master request
        //     return;
        // }
        
        // kernel instance handling the current request
        // $kernel = $event->getKernel();
        
        // the currently handled request
        // $request = $event->getRequest();
    }
    
    /**
     * Listener for the `module_dispatch.preexecute` event.
     *
     * Occurs in `ModUtil::exec()` before function call with the following args:
     *     `array('modname' => $modname,
     *            'modfunc' => $modfunc,
     *            'args' => $args,
     *            'modinfo' => $modinfo,
     *            'type' => $type,
     *            'api' => $api)`
     * .
     *
     * @param Zikula_Event $event The event instance.
     */
    public static function preExecute(Zikula_Event $event)
    {
        parent::preExecute($event);
    
        // you can access general data available in the event
        
        // the event name
        // echo 'Event: ' . $event->getName();
        
        // type of current request: MASTER_REQUEST or SUB_REQUEST
        // if a listener should only be active for the master request,
        // be sure to check that at the beginning of your method
        // if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
        //     // don't do anything if it's not the master request
        //     return;
        // }
        
        // kernel instance handling the current request
        // $kernel = $event->getKernel();
        
        // the currently handled request
        // $request = $event->getRequest();
    }
    
    /**
     * Listener for the `module_dispatch.postexecute` event.
     *
     * Occurs in `ModUtil::exec()` after function call with the following args:
     *     `array('modname' => $modname,
     *            'modfunc' => $modfunc,
     *            'args' => $args,
     *            'modinfo' => $modinfo,
     *            'type' => $type,
     *            'api' => $api)`
     * .
     * Receives the modules output with `$event->getData();`.
     * Can modify this output with `$event->setData($data);`.
     *
     * @param Zikula_Event $event The event instance.
     */
    public static function postExecute(Zikula_Event $event)
    {
        parent::postExecute($event);
    
        // you can access general data available in the event
        
        // the event name
        // echo 'Event: ' . $event->getName();
        
        // type of current request: MASTER_REQUEST or SUB_REQUEST
        // if a listener should only be active for the master request,
        // be sure to check that at the beginning of your method
        // if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
        //     // don't do anything if it's not the master request
        //     return;
        // }
        
        // kernel instance handling the current request
        // $kernel = $event->getKernel();
        
        // the currently handled request
        // $request = $event->getRequest();

        // we get the module args for the event
        $modargs = $event->getArgs();

        if (in_array($modargs['modname'], array('Blocks', 'Admin'))) {
            // nothing to do for module blocks
            return;
        }

        if ($modargs['type'] == 'admin') {
            // admin call, thus nothing to do
            return;
        }

        // check if MUSeo is activated for any modules
        $modules = MUSeo_Api_HandleModules::checkModules();
        if (!is_array($modules) || count($modules) < 1) {
            // no active modules, thus nothing to do
            return;
        }

        // get list of allowed controllers
        $controllers = ModUtil::getVar('MUSeo', 'controllers');
        $controllers = explode(',', $controllers);

        if (!in_array($modargs['modfunc'][1], $controllers)) {
            // unallowed controller, thus nothing to do
            return;
        }

        //LogUtil::registerStatus($modargs['modfunc'][1]);

        // we are not interested in api functions
        if ($modargs['api'] == 1) {
            return;
        }
        
        if(PageUtil::isHomepage()){
        	$modVars = ModUtil::getVar('MUSeo');
        	$metaTags = array();
        	
        	if ( $modVars['alexaVerify'] !== '' ) {
        		$metaTags = '<meta name="alexaVerifyID" content="' . $modVars['alexaVerify'] . '">';
        	}
        	
        	// Bing
        	if ( $modVars['msVerify'] !== '' ) {
        		$metaTags = '<meta name="msvalidate.01" content="' . $modVars['msVerify'] . '">';
        	}
        	
        	// Google
        	if ( $modVars['googleVerify'] !== '' ) {
        		$metaTags = '<meta name="google-site-verification" content="' . $modVars['googleVerify'] . '">';
        	}
        	
        	// Pinterest
        	if ( $modVars['pinterestVerify'] !== '' ) {
        		$metaTags = '<meta name="p:domain_verify" content="' . $modVars['pinterestVerify'] . '">';
        	}
        	
        	// Yandex
        	if ( $modVars['yandexVerify'] !== '' ) {
        		$metaTags = '<meta name="yandex-verification" content="' . $modVars['yandexVerify'] . '">';;
        	}
        	
        	if (count($metaTags) > 0) {
        		PageUtil::addVar('header', implode("\n", $metaTags));
        	}
        }

        // now check if an entry for the module exists with corresponding name and func
        $metatagRepository = MUSeo_Util_Model::getMetatagRepository();
        $where = 'tbl.theModule = \'' . DataUtil::formatForStore($modargs['modname']) . '\'';
        $where .= ' AND ';
        $where .= 'tbl.functionOfModule = \'' . DataUtil::formatForStore($modargs['modfunc'][1]) . '\'';
        $count = $metatagRepository->selectCount($where);

        if ($count < 1) {
            // there is no entry
            return;
        }

        // set the metatags accordingly
        MUSeo_Api_HandleModules::setModuleMetaTags($modargs['modname'], $modargs['modfunc'][1]);
    }
    
    /**
     * Listener for the `module_dispatch.custom_classname` event.
     *
     * In order to override the classname calculated in `ModUtil::exec()`.
     * In order to override a pre-existing controller/api method, use this event type to override the class name that is loaded.
     * This allows to override the methods using inheritance.
     * Receives no subject, args of `array('modname' => $modname, 'modinfo' => $modinfo, 'type' => $type, 'api' => $api)`
     * and 'event data' of `$className`. This can be altered by setting `$event->setData()` followed by `$event->stop()`.
     *
     * @param Zikula_Event $event The event instance.
     */
    public static function customClassname(Zikula_Event $event)
    {
        parent::customClassName($event);
    
        // you can access general data available in the event
        
        // the event name
        // echo 'Event: ' . $event->getName();
        
        // type of current request: MASTER_REQUEST or SUB_REQUEST
        // if a listener should only be active for the master request,
        // be sure to check that at the beginning of your method
        // if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
        //     // don't do anything if it's not the master request
        //     return;
        // }
        
        // kernel instance handling the current request
        // $kernel = $event->getKernel();
        
        // the currently handled request
        // $request = $event->getRequest();
    }
    
    /**
     * Listener for the `module_dispatch.service_links` event.
     *
     * Occurs when building admin menu items.
     * Adds sublinks to a Services menu that is appended to all modules if populated.
     * Triggered by module_dispatch.postexecute in bootstrap.
     *
     * @param Zikula_Event $event The event instance.
     */
    public static function serviceLinks(Zikula_Event $event)
    {
        parent::customClassName($event);
    
        // Format data like so:
        // $event->data[] = array('url' => ModUtil::url('MUSeo', 'user', 'main'), 'text' => __('Link Text'));
    
        // you can access general data available in the event
        
        // the event name
        // echo 'Event: ' . $event->getName();
        
        // type of current request: MASTER_REQUEST or SUB_REQUEST
        // if a listener should only be active for the master request,
        // be sure to check that at the beginning of your method
        // if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
        //     // don't do anything if it's not the master request
        //     return;
        // }
        
        // kernel instance handling the current request
        // $kernel = $event->getKernel();
        
        // the currently handled request
        // $request = $event->getRequest();
    }
}
