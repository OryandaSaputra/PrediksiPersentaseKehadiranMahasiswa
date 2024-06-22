<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendancePredictionController extends Controller
{
    public function index()
    {
        return view('prediction_form');
    }

    public function predict(Request $request)
    {
        $validated = $request->validate([
            'on_time_frequency' => 'required|string',
            'semester_compensations' => 'required|string',
            'organization_absences' => 'required|string',
        ]);

        $onTime = $validated['on_time_frequency'];
        $compensations = $validated['semester_compensations'];
        $absences = $validated['organization_absences'];

        $attendanceRate = 'Tidak diketahui';

        if ($onTime === 'Selalu') {
            if ($compensations === '0 - 5 jam' && $absences === 'Tidak Pernah') {
                $attendanceRate = '80% - 85%';
            } elseif ($compensations === '0 - 5 jam' && $absences === 'Jarang') {
                $attendanceRate = '86% - 90%';
            } elseif ($compensations === '> 10 jam' && $absences === 'Jarang') {
                $attendanceRate = '91% - 100%';
            } elseif ($compensations === '6 - 9 jam' && $absences === 'Tidak Pernah') {
                $attendanceRate = '80% - 85%';
            } elseif ($compensations === '> 10 jam' && $absences === 'Tidak Pernah') {
                $attendanceRate = '80% - 85%';
            }
        } elseif ($onTime === 'Jarang') {
            if ($compensations === '> 10 jam' && $absences === 'Tidak Pernah') {
                $attendanceRate = '80% - 85%';
            } elseif ($compensations === '> 10 jam' && $absences === 'Jarang') {
                $attendanceRate = '86% - 90%';
            } elseif ($compensations === '0 - 5 jam' && $absences === 'Jarang') {
                $attendanceRate = '91% - 100%';
            } elseif ($compensations === '0 - 5 jam' && $absences === 'Tidak Pernah') {
                $attendanceRate = '91% - 100%';
            }
        } elseif ($onTime === 'Tidak Pernah') {
            if ($compensations === '0 - 5 jam' && $absences === 'Tidak Pernah') {
                $attendanceRate = '80% - 85%';
            } elseif ($compensations === '0 - 5 jam' && $absences === 'Jarang') {
                $attendanceRate = '86% - 90%';
            } elseif ($compensations === '6 - 9 jam' && $absences === 'Tidak Pernah') {
                $attendanceRate = '86% - 90%';
            } elseif ($compensations === '0 - 5 jam' && $absences === 'Tidak Pernah') {
                $attendanceRate = '91% - 100%';
            } elseif ($compensations === '6 - 9 jam' && $absences === 'Jarang') {
                $attendanceRate = '86% - 90%';
            }
        }

        return response()->json(['message' => 'Prediksi persentase kehadiran Anda adalah: ' . $attendanceRate]);
    }
}
