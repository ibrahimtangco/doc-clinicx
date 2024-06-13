<?php

namespace App\Services;

class PatientService
{

    public function searchResults($patients)
    {
        $searchDisplay = '';

        foreach ($patients as $patient) {
            $searchDisplay .= '
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4">' . $patient->first_name . '</td>
                    <td class="px-6 py-4">' . $patient->middle_name . '</td>
                    <td class="px-6 py-4">' . $patient->last_name . '</td>
                    <td class="px-6 py-4">' . $patient->address . '</td>
                    <td class="px-6 py-4">' . $patient->email . '</td>
                    <td class="px-6 py-4 text-right space-x-2 flex items-center">
                        <a class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 flex items-center justify-center gap-1 w-fit"
                            href="' . route('show.patient.record', ['patient' => $patient->id]) . '"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <path d="M12 9a3 3 0 1 0 0 6 3 3 0 1 0 0-6z"></path>
                                                            </svg>
                                                            <span>View</span></a>

                            <a class="font-medium text-white bg-orange-600 px-2 py-1 rounded hover:bg-orange-700 flex items-center justify-center gap-1 w-fit"
                            href="' . route('patients.edit', ['patient' => $patient->id]) . '"><svg width="15" height="15" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                        <span>Edit</span></a>
                    </td>
                </tr>';
        }

        return $searchDisplay;
    }
}
