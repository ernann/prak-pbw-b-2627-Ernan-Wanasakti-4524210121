<?php
function statusKelulusan(float $ipk): string 
{
    if($ipk >= 3.50) return 'Sangat Memuaskan';
    if($ipk >= 3.00) return 'Memuaskan';
    return 'Perlu Peningkatan';
}

$mahasiswa =[
    'nim' => '4524210121';
    ''
]