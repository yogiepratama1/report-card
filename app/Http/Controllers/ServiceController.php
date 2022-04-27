<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function calculate_final()  // Mathematics
    {
        $reports = Report::all();
        foreach ($reports as $report) {
            $total = $report->harian + $report->uts + $report->uas;
            $report->final = $total / 3;
            $report->save();
        }
        return redirect('/dashboard')->with('success', 'Data berhasil diperbarui');
    }

    public function calculate_grade() // Nested If
    {
        $reports = Report::all();
        if ($reports) {
            foreach ($reports as $report) {
                if ($report->final >= 90) {
                    $report->grade = 'A';
                } elseif ($report->final >= 80) {
                    $report->grade = 'B';
                } elseif ($report->final >= 70) {
                    $report->grade = 'C';
                } elseif ($report->final >= 60) {
                    $report->grade = 'D';
                } elseif ($report->final < 60) {
                    $report->grade = 'E';
                }
                $report->save();
            }
        } else {
            return redirect('/dashboard')->with('error', 'Data tidak ditemukan');
        }
        return redirect('/dashboard')->with('success', 'Data berhasil diperbarui');
    }

    public function generate_random_report(Request $request) // Nested Loop
    {
        $total = $request['jumlah'];
        for ($i = 0; $i < $total; $i++) {
            $report = new Report;
            $report->harian = rand(0, 100);
            $report->uts = rand(0, 100);
            for ($j = 10; $j < $i; $j++) {
                $report->uas = rand(0, 100);
            }
            $report->save();
        }
        return redirect('/dashboard')->with('success', 'Data berhasil diperbarui');
    }

    public function fill_blank_uas()
    {
        $reports = Report::all();
        if ($reports) {
            foreach ($reports as $report) {
                if ($report->uas == null) {
                    $report->uas = rand(0, 100);
                    $report->save();
                }
            }
        } else {
            return redirect('/dashboard')->with('error', 'Data tidak ditemukan');
        }
        return redirect('/dashboard')->with('success', 'Data berhasil diperbarui');
    }

    public function count_characters(Request $request) // Check characters
    {
        $text = str_split($request['text']);
        $text2 = $request['text2'];
        $text1 = strtolower($request['text']);
        // echo substr_count($text2, $text[4]);
        for ($i = 0; $i < strlen($text1); $i++) {
            $value = substr_count(strtolower($text2), $text[$i]);
            if ($value > 0) {
                $data =  $text[$i] . ":" . $value . "<br>";
                echo "<h1>" . $data . "</h1>";
            }
        }
    }
}
