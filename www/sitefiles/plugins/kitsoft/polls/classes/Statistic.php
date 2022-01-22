<?php namespace KitSoft\Polls\Classes;

use ApplicationException;
use Exception;
use KitSoft\Polls\Models\Poll;
use October\Rain\Argon\Argon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Statistic
{
    protected $poll;
    protected $spreadsheet;
    protected $writer;
    protected $fromDate;
    protected $toDate;

    protected $lists = 0;

    /**
     * __construct
     */
    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
        $this->spreadsheet = new Spreadsheet();
        $this->writer = new Xls($this->spreadsheet);
    }

    /**
     * download
     */
    public function download()
    {
        $filename = sprintf('Poll-Statistic %s [%s-%s].xls',
            str_slug($this->poll->title),
            $this->fromDate->format('d/m/Y'),
            $this->toDate->format('d/m/Y')
        );

        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename={$filename}");
        header('Cache-Control: max-age=0');

        die($this->writer->save("php://output"));
    }

    /**
     * setFromDate
     */
    public function setFromDate(string $date)
    {
        $this->fromDate = Argon::parse($date);
    }

    /**
     * setToDate
     */
    public function setToDate(string $date)
    {
        $this->toDate = Argon::parse($date);
    }

    /**
     * addVotesList
     */
    public function addVotesList()
    {
        try {
            if ($this->lists) {
                $this->spreadsheet->createSheet();
            }

            $this->spreadsheet->setActiveSheetIndex($this->lists);

            $this->lists++;

            $activeSheet = $this->spreadsheet->getActiveSheet();

            $activeSheet->setTitle('Статистика');

            $activeSheet->setCellValue('A1', 'Запитання');
            $activeSheet->setCellValue('B1', 'Відповідь');
            $activeSheet->setCellValue('C1',($this->fromDate && $this->toDate)
                ? $this->fromDate->format('d/m/Y') . ' - ' . $this->toDate->format('d/m/Y')
                : 'За період'
            );
            $activeSheet->setCellValue('D1', 'Взагалі');

            $startCell = $endCell = 1;

            $this->poll->all_questions->each(function ($question, $key) use ($activeSheet, &$startCell, &$endCell) {
                $startCell = $endCell + 2;
                $endCell = $startCell - 1 + $question->options->count();

                $activeSheet->setCellValue("A{$startCell}", $question->title)
                    ->mergeCells("A{$startCell}:A{$endCell}")
                    ->getStyle("A{$startCell}:A{$endCell}")
                    ->getAlignment()
                    ->setHorizontal('center')
                    ->setVertical('center');

                $activeSheet->getStyle("A{$startCell}:A{$endCell}")
                    ->getFont()
                    ->setBold(true);

                $question->options->each(function ($option, $key) use ($activeSheet, $startCell) {
                    $cell = (int)($startCell + $key);

                    $query = $option->logs();

                    if ($this->fromDate) {
                        $query = $query->whereDate('created_at', '>=', $this->fromDate);
                    }

                    if ($this->toDate) {
                        $query = $query->whereDate('created_at', '<=', $this->toDate);
                    }

                    $activeSheet->setCellValue("B{$cell}", $option->text);
                    $activeSheet->setCellValue("C{$cell}", $query->count());
                    $activeSheet->setCellValue("D{$cell}", $option->votes);
                });
            });

            $activeSheet->getColumnDimension('A')->setAutoSize(true);
            $activeSheet->getColumnDimension('B')->setAutoSize(true);
            $activeSheet->getColumnDimension('C')->setAutoSize(true);
            $activeSheet->getColumnDimension('D')->setAutoSize(true);
        } catch (Exception $e) {
            trace_log($e);
            throw new ApplicationException('Error. See logs.');
        }
    }

    /**
     * addCommentsList
     */
    public function addCommentsList()
    {
        try {
            $counter = 1;

            if ($this->lists) {
                $this->spreadsheet->createSheet();
            }

            $this->spreadsheet->setActiveSheetIndex($this->lists);

            $this->lists++;

            $activeSheet = $this->spreadsheet->getActiveSheet();

            $activeSheet->setTitle('Коментарі');

            $activeSheet->setCellValue("A{$counter}", 'Запитання');
            $activeSheet->setCellValue("B{$counter}", 'Відповідь');
            $activeSheet->setCellValue("C{$counter}", 'Коментар');

            $query = $this->poll->logs();

            if ($this->fromDate) {
                $query = $query->whereDate('created_at', '>=', $this->fromDate);
            }

            if ($this->toDate) {
                $query = $query->whereDate('created_at', '<=', $this->toDate);
            }

            $query
                ->orderBy('created_at', 'desc')
                ->chunk(5, function ($items) use ($activeSheet, &$counter) {
                    $items->each(function ($item) use ($activeSheet, &$counter) {
                        foreach ($item->log as $question) {
                            if (!$options = array_get($question, 'options')) {
                                continue;
                            }

                            foreach ($options as $option) {
                                if (!$comment = array_get($option, 'comment')) {
                                    continue;
                                }

                                $counter++;

                                $activeSheet->setCellValue("A{$counter}", array_get($question, 'title'));
                                $activeSheet->setCellValue("B{$counter}", array_get($option, 'text'));
                                $activeSheet->setCellValue("C{$counter}", array_get($option, 'comment'));
                            }
                        }       
                    });
                });

            $activeSheet->getColumnDimension('A')->setAutoSize(true);
            $activeSheet->getColumnDimension('B')->setAutoSize(true);
            $activeSheet->getColumnDimension('C')->setAutoSize(true);
        } catch (Exception $e) {
            trace_log($e);
            throw new ApplicationException('Error. See logs.');
        }
    }
}
