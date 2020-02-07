<?php
/**
 * PositionController.php - Main Controller
 *
 * Main Controller Position Module
 *
 * @category Controller
 * @package Position
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Job\Controller;

use Application\Controller\CoreEntityController;
use Application\Model\CoreEntityModel;
use OnePlace\Job\Model\Position;
use OnePlace\Job\Model\PositionTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class PositionController extends CoreEntityController {
    /**
     * Position Table Object
     *
     * @since 1.0.0
     */
    protected $oTableGateway;

    /**
     * PositionController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param PositionTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,PositionTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'jobposition-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    /**
     * Position Index
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function indexAction() {
        # You can just use the default function and customize it via hooks
        # or replace the entire function if you need more customization
        return $this->generateIndexView('jobposition');
    }

    /**
     * Position Add Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function addAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * jobposition-add-before (before show add form)
         * jobposition-add-before-save (before save)
         * jobposition-add-after-save (after save)
         */
        return $this->generateAddView('jobposition');
    }

    /**
     * Position Edit Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function editAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * jobposition-edit-before (before show edit form)
         * jobposition-edit-before-save (before save)
         * jobposition-edit-after-save (after save)
         */
        return $this->generateEditView('jobposition');
    }

    /**
     * Position View Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function viewAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * jobposition-view-before
         */
        return $this->generateViewView('jobposition');
    }
}
