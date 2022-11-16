<?php

class CalendarController extends Controller
{
    /** @var \model\Work $workModel */
    private $workModel;

    /**
     * @constructor
     * @description: call model work
     */
    public function __construct()
    {
        $this->workModel = $this->model('Work');
    }

    /**
     * index
     * @description: show work list calendar
     * @response: view calendar
     */
    function index()
    {
        $works = $this->workModel->allWork();
        $data = [
            'works' => $works,
        ];
        $this->view('calendar/index', $data);
    }
}
