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
 * Event handler implementation class for view-related events.
 */
class MUSeo_Listener_View extends MUSeo_Listener_Base_View
{
    /**
     * Listener for the `view.init` event.
     *
     * Occurs just before `Zikula_View#__construct()` finishes.
     * The subject is the Zikula_View instance.
     *
     * @param Zikula_Event $event The event instance.
     */
    public static function init(Zikula_Event $event)
    {
        parent::init($event);
    
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
     * Listener for the `view.postfetch` event.
     *
     * Filter of result of a fetch.
     * Receives `Zikula_View` instance as subject,
     * args are `array('template' => $template)`,
     * $data was the result of the fetch to be filtered.
     *
     * @param Zikula_Event $event The event instance.
     */
    public static function postFetch(Zikula_Event $event)
    {
        parent::postFetch($event);
    
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
