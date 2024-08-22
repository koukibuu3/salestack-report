<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\InvoicePostRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

/**
 * 請求書に関する操作を扱う
 */
final class InvoiceController extends BaseController
{
    public function index(Request $req, Response $res): Response
    {
        return $res->setContent('sample');
    }

    /**
     * @method POST
     */
    public function output(InvoicePostRequest $req, Response $res)
    {
        echo 'InvoiceController->output' . PHP_EOL;
        echo json_encode($req) . PHP_EOL;

        $this->setHeader();

        $param = new OutputRequestParameter($req);
        $report = (new CreateReportService(
            $param->customerName,
            $param->fromDate,
            $param->toDate,
            $param->sales,
        ))->run();

        (new OutputReportService($report))->run();
    }

    /**
     * ヘッダーを設定
     */
    private function setHeader(): void
    {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="test.xlsx"');
        header('Cache-Control: max-age=0');
    }
}
