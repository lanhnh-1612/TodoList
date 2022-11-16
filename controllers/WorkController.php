<?php

class WorkController extends Controller
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
     * @description: show list work
     * @response: view index work
     */
    function index()
    {
        $arrSearch = [
            'name'          =>  isset($_GET['name']) ? $_GET['name'] : null,
            'starting_date' =>  isset($_GET['starting_date']) ? $_GET['starting_date'] : null,
            'ending_date'   =>  isset($_GET['ending_date']) ? $_GET['ending_date'] : null,
            'status'        =>  isset($_GET['status']) ? $_GET['status'] : null
        ];

        $works = $this->workModel->listWork($arrSearch);
        $statuses = $this->workModel::ARR_STATUS;

        $data = [
            'works' => $works,
            'statuses' => $statuses,
        ];

        $this->view('work/index', $data);
    }

    /**
     * add
     * @description: show view add work
     * @response: view add work
     */
    function create()
    {
        $statuses = $this->workModel::ARR_STATUS;
        $data = [
            'statuses' => $statuses,
        ];
        $this->view('work/create', $data);
    }

    /**
     * store
     * @description: store work
     */
    function store()
    {
        $statuses = $this->workModel::ARR_STATUS;
        $request = new Request;
        if ($request->isPost()) {
            $this->setValidate($request, $statuses);

            $validate = $request->validate();
            $dataRq = $request->getFields();

            if ($validate) {
                $this->workModel->addWork($dataRq);
                $url = BASE_URL . '/work/index';
                header("Location: " . $url);
                exit;
            } else {
                $errors = $request->errors();
                $data = [
                    'errors' => $errors,
                    'statuses' => $statuses,
                    'dataOld' => $dataRq,
                ];
                $this->view('work/create', $data);
            }
        } else {
            $this->errors('exception');
        }
    }

    /**
     * set rule and message validate
     */
    private function setValidate($request, $statuses)
    {
        $request->rules([
            'name' => 'required|max:255',
            'starting_date' => 'required|date_format',
            'ending_date' => 'required|date_format',
            'status' => 'required|in:' . implode(',', $statuses),
        ]);

        $request->message([
            'name.required' => 'Name work is required.',
            'name.max' => 'Name work may not be greater than 255 characters.',
            'starting_date.required' => 'Starting date is required.',
            'starting_date.date_format' => 'Starting date does not match the format.',
            'ending_date.required' => 'Ending date is required.',
            'ending_date.date_format' => 'Ending date does not match the format.',
            'status.required' => 'Status is required.',
            'status.in' => 'The selected status is invalid.',
        ]);
    }

    /**
     * edit
     * @description: edit work
     * @response: view edit work
     */
    function edit()
    {
        $id = $_GET['id'];

        $work = $this->workModel->findWork($id);
        if (empty($work)) {
            $this->errors('exception');
        }
        $statuses = $this->workModel::ARR_STATUS;
        $data = [
            'statuses' => $statuses,
            'oldWork' => $work,
        ];
        $this->view('work/edit', $data);
    }

    /**
     * update
     * @description: update work
     */
    function update()
    {
        $id = $_POST['id'];

        $work = $this->workModel->findWork($id);
        if (empty($work)) {
            $this->errors('exception');
        }

        $statuses = $this->workModel::ARR_STATUS;
        $request = new Request;
        if ($request->isPost()) {
            $this->setValidate($request, $statuses);

            $validate = $request->validate();
            $dataRq = $request->getFields();

            if ($validate) {
                $this->workModel->updateWork($dataRq);
                $url = BASE_URL . '/work/index';
                header("Location: " . $url);
                exit;
            } else {
                $errors = $request->errors();
                $data = [
                    'errors' => $errors,
                    'statuses' => $statuses,
                    'dataOld' => $dataRq,
                ];
                $this->view('work/edit', $data);
            }
        }
    }

    /**
     * delete
     * @description: delete work
     */
    function delete()
    {
        $id = $_GET['id'];

        $work = $this->workModel->findWork($id);
        if (empty($work)) {
            $this->errors('exception');
        }

        $this->workModel->deleteWork($id);

        $url = BASE_URL . '/work/index';
        header("Location: " . $url);
        exit;
    }
}
