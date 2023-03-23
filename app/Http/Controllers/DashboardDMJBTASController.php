<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashboardBTAJ;
use App\Models\HutangDMJBTA;
use App\Models\PiutangDMJBTA;
use App\Models\ReturbeliDMJBTA;
use App\Models\ReturjualDMJBTA;
use App\Models\SOheaderDMJBTA;
use App\Models\StokbulanDMJBTA;
use App\Models\StokkartuDMJBTA;
use Illuminate\Support\Facades\DB;


class DashboardDMJBTASController extends Controller
{
    public function dashboarddmjbta()
    {

        $data['penjaualndb22'] = DashboardBTAJ::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->where("stat", '6')
            ->orwhere("stat", '2')
            ->count();

        $data['sumpenjualandb22'] = DashboardBTAJ::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->where("stat", '6')
            ->orwhere("stat", '2')
            ->sum('Netto');

        //card retur jual
        $data['countreturgeneral'] = ReturjualDMJBTA::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->where("stat", '6')
            ->count();

        $data['sumstretur'] = ReturjualDMJBTA::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->where("stat", '6')
            ->sum('Netto');

        //card Piutang
        $data['sumspiutang'] = PiutangDMJBTA::whereMonth("Tgl", date('m'))
            // ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereYear("Tgl", date('Y'))
            ->sum('Netto');
        $data['countspiutang'] = PiutangDMJBTA::whereMonth("Tgl", date('m'))
            // ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereYear("Tgl", date('Y'))
            ->count();

        //card Piutang
        $data['sumshutang'] = HutangDMJBTA::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->where('kdsupplier', '!=', 'k28')
            ->sum('Netto');

        $data['countshutang'] = HutangDMJBTA::whereMonth("TglJTempo", '>=', date('m'))
            ->whereYear("TglJTempo", '>=', date('Y'))
            ->count();

        $data['sumshutangperprincipal'] = HutangDMJBTA::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereNotIn('kdsupplier', ['k28'])
            ->groupBy(DB::raw("KdSupplier"))
            ->select(DB::raw('KdSupplier , SUM(netto) as sumprincipal'))
            ->get();
        // dd($datab);

        $data['sumshutangperprincipaltgl'] = HutangDMJBTA::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereNotIn('kdsupplier', ['k28'])
            ->groupBy(DB::raw("KdSupplier, TglJTempo"))
            // ->orderBy(DB::raw("CASE WHEN TglJTempo >=CURRENT_DATE() THEN 'Hutang Masih Ada' END"))
            ->orderBy('TglJTempo', 'DESC')
            ->select(DB::raw('KdSupplier, TglJTempo, SUM(netto) as sumprincipaltgl, DATEDIFF(TglJTempo,CURRENT_DATE()) AS Jumlah_Haritgl'))
            ->get();

        $data['sumreturbeli'] = ReturbeliDMJBTA::whereMonth("tgl", date('m'))
            ->whereYear("tgl", date('Y'))
            ->sum('Netto');

        $data['sumsodaily'] = SOheaderDMJBTA::where('tgl', date('Y-m-d'))
            ->sum('netto');

        $data['fakturbatal'] = DashboardBTAJ::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->where("stat", '4')
            ->sum('Netto');


        $stokK = StokkartuDMJBTA::where("mk", "k")
            ->select(DB::raw('SUM(hpp*qty) as stokk'))
            ->get();
        $stokM = StokkartuDMJBTA::where("mk", "m")
            ->select(DB::raw("SUM(hpp*qty) as stokm"))
            ->get();

        $arraystokk = $stokK[0]['stokk'];
        $arraystokm = $stokM[0]['stokm'];
        $totalkartustok = $arraystokm - $arraystokk;
        // dd(round($totalkartustok));

        $bulanika = DashboardBTAJ::select(DB::raw("MONTHNAME(TglKirim) as bulanika"))
            ->GroupBy(DB::raw("MONTHNAME(TglKirim)"))
            ->OrderBy(DB::raw("MONTH(TglKirim)"))
            ->whereYear("TglKirim", '2021')
            ->whereNotIn('TglKirim', ['null'])
            ->pluck('bulanika');


        $nilaiika = DashboardBTAJ::where("stat", '6')
            ->GroupBy(DB::raw("MONTHNAME(TglKirim)"))
            ->select(DB::raw('SUM(Netto) as nilaiika'))
            ->OrderBy(DB::raw("MONTH(TglKirim)"))
            ->whereYear("TglKirim", date('Y'))
            ->pluck('nilaiika');

        $salesoutsalesmanika = DashboardBTAJ::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->orderBy(DB::raw("kdslm"))
            ->where('kdslm', '!=', "")
            ->where('kdslm', '!=', "07")
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, SUM(Netto) AS salesoutsalesmanika'))
            ->pluck('salesoutsalesmanika');

        $sumsalesmanika = DashboardBTAJ::join('salesman', 'fakturjualheader.kdslm', '=', 'salesman.kdslm')
            ->whereMonth("fakturjualheader.TglKirim", date('m'))
            ->whereYear("fakturjualheader.TglKirim", date('Y'))
            ->where('fakturjualheader.kdslm', '!=', "")
            ->select(DB::raw('salesman.NmSlm as sumsalesmanika'))
            ->orderBy(DB::raw("fakturjualheader.kdslm"))
            ->groupBy(DB::raw("salesman.NmSlm"))
            ->pluck('sumsalesmanika');
        // ->get();
        // dd($sumsalesmanika);

        $saldostok99 = StokbulanDMJBTA::join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
            ->join('supplier', 'supplier.KdSupplier', '=', 'barang.KdSupplier')
            ->where('stokbulan.tahun', date('Y'))
            ->where('stokbulan.kdGudang', "99")
            ->where('supplier.KdSupplier', '!=', "k21")
            ->where('supplier.KdSupplier', '!=', "k24")
            ->where('supplier.KdSupplier', '!=', "k30")
            ->where('supplier.KdSupplier', '!=', "k31")
            ->where('barang.Stat', '!=', "2")
            ->where('supplier.Stat', '!=', "2")
            // ->groupBy(DB::raw("barang.KdSupplier"))
            ->select(
                // DB::raw('barang.KdSupplier, stokbulan.kdgudang, stokbulan.Nawal,supplier.NamaSupplier'),
                // DB::raw('SUM(stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3) AS Total_masuk'),
                // DB::raw('SUM(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) AS Total_masuk'),
                DB::raw('SUM((stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3)-(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) + Nawal) AS Sisa_saldo99')
            )
            ->get();
        $saldostok98 = StokbulanDMJBTA::join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
            ->join('supplier', 'supplier.KdSupplier', '=', 'barang.KdSupplier')
            ->where('stokbulan.tahun', date('Y'))
            ->where('stokbulan.kdGudang', "98")
            ->where('supplier.KdSupplier', '!=', "k21")
            ->where('supplier.KdSupplier', '!=', "k24")
            ->where('supplier.KdSupplier', '!=', "k30")
            ->where('supplier.KdSupplier', '!=', "k31")
            ->where('barang.Stat', '!=', "2")
            ->where('supplier.Stat', '!=', "2")
            // ->groupBy(DB::raw("barang.KdSupplier"))
            ->select(
                // DB::raw('barang.KdSupplier, stokbulan.kdgudang, stokbulan.Nawal,supplier.NamaSupplier'),
                // DB::raw('SUM(stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3) AS Total_masuk'),
                // DB::raw('SUM(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) AS Total_masuk'),
                DB::raw('SUM((stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3)-(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) + Nawal) AS Sisa_saldo98')
            )
            ->get();

        $arraysaldostok98 = $saldostok98[0]['Sisa_saldo98'];
        $arraysaldostok99 = $saldostok99[0]['Sisa_saldo99'];

        $data['totalsaldostok'] = $arraysaldostok98 + $arraysaldostok99;


        return view('dashboarddmj.bta', ['bulanika' => $bulanika, 'totalkartustok' => $totalkartustok, 'sumsalesmanika' => $sumsalesmanika, 'salesoutsalesmanika' => $salesoutsalesmanika, 'nilaiika' => $nilaiika], $data);
    }
}
