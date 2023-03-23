<?php

namespace App\Http\Controllers;

use App\Models\Customerlog;
use Illuminate\Http\Request;
use App\Models\Fakturjual;
use App\Models\Hutang;
use App\Models\Piutang;
use App\Models\ReturJual;
use App\Models\ReturPembelian;
use App\Models\Salesman;
use App\Models\Soheader;
use App\Models\Somobileheader;
use App\Models\Stokbulan;
use App\Models\StokbulanIKA;
use App\Models\StokKartu;
use App\Models\Supplier;
use App\Models\TargetSalesman;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardDMJ extends Controller
{
    public function createtarget(Request $request)
    {
        $targetsales = new TargetSalesman();
        $targetsales->salesmans_id = $request->salesmans_id;
        $targetsales->jcust = $request->jcust;
        $targetsales->jnilai = $request->jnilai;
        $targetsales->save();
        return redirect()->route('DMJS');
    }
    public function dashboarddmj()
    {

        $saldostok99 = Stokbulan::join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
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

        $saldostok98 = Stokbulan::join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
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

        // $data['saldostokall'] = Stokbulan::innerjoin("barang", function ($join) {
        //     $join->on("stokbulan.kdbrg", "=", "barang.kdbrg");
        // })
        //     ->innerJoin("supplier", function ($join) {
        //         $join->on("supplier.kdsupplier", "=", "barang.kdsupplier")
        //             ->where("barang.stat", "!=", 2)
        //             ->where("supplier.kdsupplier", "!=", 'k21')
        //             ->where("supplier.kdsupplier", "!=", 'k24')
        //             ->where("supplier.kdsupplier", "!=", 'k30')
        //             ->where("supplier.kdsupplier", "!=", 'k31')
        //             ->where("supplier.kdsupplier", "!=", '99')
        //             ->where("stokbulan.tahun", "=", '2022');
        //     })
        //     ->select("stokbulan.tahun", "supplier.`namasupplier`", "stokbulan.nawal", "sum (stokbulan.nm1+stokbulan.nm2+stokbulan.nm3) as total_masuk", "sum (stokbulan.nk1+stokbulan.nk2+stokbulan.nk3) as total_keluar", "sum ((stokbulan.nm1+stokbulan.nm2+stokbulan.nm3)- (stokbulan.nk1+stokbulan.nk2+stokbulan.nk3) + nawal)as sisa_saldo")
        //     ->where("stokbulan.kdgudang", "=", '98')
        //     ->where("stokbulan.kdgudang", "=", '99')
        //     ->groupBy("barang")
        //     ->get();

        $arraysaldostok98 = $saldostok98[0]['Sisa_saldo98'];
        $arraysaldostok99 = $saldostok99[0]['Sisa_saldo99'];
        // dd($saldostok99);
        $data['totalsaldostok'] = $arraysaldostok98 + $arraysaldostok99;

        $plucksaldostokall99['saldostokall98'] = Stokbulan::select(
                DB::raw('SUM((stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3)-(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) + Nawal) AS Sisa_saldoall99')
            )->join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
            ->join('supplier', 'supplier.KdSupplier', '=', 'barang.KdSupplier')
            ->where('stokbulan.kdGudang', "99")
            ->where('stokbulan.tahun','2022')
            ->where('supplier.KdSupplier', '!=', "k21")
            ->where('supplier.KdSupplier', '!=', "k24")
            ->where('supplier.KdSupplier', '!=', "k30")
            ->where('supplier.KdSupplier', '!=', "k31")
            ->where('supplier.KdSupplier', '!=', "99")
            ->where('barang.Stat', '!=', "2")
            ->where('supplier.Stat', '!=', "2")
            // ->groupBy(DB::raw("supplier.KdSupplier"))
            ->groupBy("supplier.NamaSupplier")
            ->pluck('Sisa_saldoall99');

        $plucksaldostokall98['saldostokall98'] = Stokbulan::select(
                DB::raw('SUM((stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3)-(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) + Nawal) AS Sisa_saldoall98')
            )->join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
            ->join('supplier', 'supplier.KdSupplier', '=', 'barang.KdSupplier')
            ->where('stokbulan.kdGudang', "98")
            ->where('stokbulan.tahun','2022')
            ->where('supplier.KdSupplier', '!=', "k21")
            ->where('supplier.KdSupplier', '!=', "k24")
            ->where('supplier.KdSupplier', '!=', "k30")
            ->where('supplier.KdSupplier', '!=', "k31")
            ->where('supplier.KdSupplier', '!=', "99")
            ->where('barang.Stat', '!=', "2")
            ->where('supplier.Stat', '!=', "2")
            // ->groupBy(DB::raw("supplier.KdSupplier"))
            ->groupBy("supplier.NamaSupplier")
            ->pluck('Sisa_saldoall98');

        $data['saldostokall'] = Stokbulan::select(
                // DB::raw('supplier.KdSupplier'),
                DB::raw('supplier.NamaSupplier'),
                DB::raw('SUM(stokbulan.Nawal+0) AS Sadlo_awal'),
                DB::raw('SUM(stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3) AS Total_masuk'),
                DB::raw('SUM(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) AS Total_keluar'),
                DB::raw('SUM((stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3)-(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) + Nawal) AS Sisa_saldoall')
            )->join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
            ->join('supplier', 'supplier.KdSupplier', '=', 'barang.KdSupplier')

            ->where('stokbulan.tahun','2022')
            ->where('supplier.KdSupplier', '!=', "k21")
            ->where('supplier.KdSupplier', '!=', "k24")
            ->where('supplier.KdSupplier', '!=', "k30")
            ->where('supplier.KdSupplier', '!=', "k31")
            ->where('supplier.KdSupplier', '!=', "99")
            ->where('barang.Stat', '!=', "2")
            ->where('supplier.Stat', '!=', "2")
            ->where('stokbulan.kdGudang', "99")
            ->orwhere('stokbulan.kdGudang', "98")
            ->groupBy("supplier.NamaSupplier")
            ->get();

// dd($plucksaldostokall99);

        $bulan = Fakturjual::select(DB::raw("MONTHNAME(TglKirim) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(TglKirim)"))
            ->OrderBy(DB::raw("MONTH(TglKirim)"))
            ->whereYear("TglKirim", '2021')
            ->whereNotIn('TglKirim', ['null'])
            ->pluck('bulan');

        $data['custlogs1'] = Customerlog::join('customer', 'customer_log.custno', '=', 'customer.CustNo')
            ->where('customer_log.tgl', date('Y-m-d'))
            ->where('customer_log.cekin', '!=', NULL)
            ->where('customer_log.kdslm', '!=', "")
            ->select(
                // DB::raw('(
                // CASE
                //     WHEN customer_log.kdslm = 01 THEN "JANAWIK"
                //     WHEN customer_log.kdslm = 19 THEN "APRIYANTO"
                //     WHEN customer_log.kdslm = 54 THEN "AWALUDIN"
                //     WHEN customer_log.kdslm = 48 THEN "SUSI"
                //     WHEN customer_log.kdslm = 41 THEN "KANTA"
                //     WHEN customer_log.kdslm = 36 THEN "NOVI YANTI"
                //     WHEN customer_log.kdslm = 34 THEN "AGUS"
                //     WHEN customer_log.kdslm = 20 THEN "HASAN"
                //     WHEN customer_log.kdslm = 32 THEN "HERMAN"
                //     WHEN customer_log.kdslm = 25 THEN "KUSNADI"
                //     WHEN customer_log.kdslm = 23 THEN "IRAWAN"
                //     WHEN customer_log.kdslm = 44 THEN "EVA LUSITA"
                //     WHEN customer_log.kdslm = 72 THEN "UMAR"
                // ELSE "UNKNOW"
                // END) AS salesmans'),
                DB::raw('*,customer.custname, TIMEDIFF(cekout, cekin) AS used_time')
            )
            ->get();
        // dd($custlogs1);


        $data['custlogs2'] = Customerlog::join('salesman', 'customer_log.kdslm', '=', 'salesman.kdslm')
            ->where('customer_log.tgl', date('Y-m-d'))
            ->where('customer_log.cekin', '!=', NULL)
            ->where('customer_log.kdslm', '!=', "")
            ->orderBy(DB::raw("salesman.kdslm"))
            ->groupBy(DB::raw("salesman.NmSlm"))
            ->select(
                DB::raw('salesman.NmSlm as salesmans'),
                DB::raw('MIN(customer_log.cekin) AS firstcekin'),
                DB::raw('COUNT(customer_log.cekin) AS callinputcard'),
                DB::raw('COUNT(customer_log.status) AS suksescard'),
                DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(customer_log.cekout) - TIME_TO_SEC(cekin))) AS used_time'),
                // DB::raw('SUM(TIME_TO_SEC(cekout) - TIME_TO_SEC(cekin) AS used_sec'),
                DB::raw('SUM(TIME_TO_SEC(customer_log.cekout) - TIME_TO_SEC(cekin))/23600*100 AS used_sec'),
                // DB::raw('SUM(TIME_TO_SEC(cekout) - TIME_TO_SEC(cekin))/18000*100 AS used_sec'),
                DB::raw('SUM(customer_log.salesorder) AS penjualan')
            )
            ->get();


        // $data['custlogs2'] = Customerlog::where('tgl', date('Y-m-d'))
        //     ->where('cekin', '!=', NULL)
        //     ->where('kdslm', '!=', "")
        //     // ->select(DB::raw('kdslm, TIMEDIFF(cekout, cekin) AS used_time'))
        //     ->select(
        //         DB::raw('(
        //         CASE
        //             WHEN kdslm = 01 THEN "JANAWIK"
        //             WHEN kdslm = 19 THEN "APRIYANTO"
        //             WHEN kdslm = 54 THEN "AWALUDIN"
        //             WHEN kdslm = 48 THEN "SUSI"
        //             WHEN kdslm = 41 THEN "KANTA"
        //             WHEN kdslm = 36 THEN "NOVI YANTI"
        //             WHEN kdslm = 34 THEN "AGUS"
        //             WHEN kdslm = 20 THEN "HASAN"
        //             WHEN kdslm = 32 THEN "HERMAN"
        //             WHEN kdslm = 25 THEN "KUSNADI"
        //             WHEN kdslm = 23 THEN "IRAWAN"
        //             WHEN kdslm = 44 THEN "EVA LUSITA"
        //             WHEN kdslm = 72 THEN "UMAR"
        //         ELSE "UNKNOW"
        //         END) AS salesmans'),
        //         DB::raw('MIN(cekin) AS firstcekin'),
        //         DB::raw('kdslm, COUNT(cekin) AS callinputcard'),
        //         DB::raw('kdslm, COUNT(status) AS suksescard'),
        //         DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(cekout) - TIME_TO_SEC(cekin))) AS used_time'),
        //         // DB::raw('SUM(TIME_TO_SEC(cekout) - TIME_TO_SEC(cekin) AS used_sec'),
        //         DB::raw('SUM(TIME_TO_SEC(cekout) - TIME_TO_SEC(cekin))/23600*100 AS used_sec'),
        //         // DB::raw('SUM(TIME_TO_SEC(cekout) - TIME_TO_SEC(cekin))/18000*100 AS used_sec'),
        //         DB::raw('SUM(salesorder) AS penjualan')
        //     )
        //     ->groupBy(DB::raw("kdslm"))
        //     ->get();

        $detikused = Customerlog::where('tgl', date('Y-m-d'))
            ->where('statusorder', '!=', NULL)
            ->where('kdslm', '!=', "")
            // ->select(DB::raw('kdslm, TIMEDIFF(cekout, cekin) AS used_time'))
            ->select(
                DB::raw('SUM(TIME_TO_SEC(cekout) - TIME_TO_SEC(cekin)) AS detikused')
            )
            ->groupBy(DB::raw("kdslm"))
            ->pluck('detikused');

        $gagal = Customerlog::where('tgl', date('Y-m-d'))
            ->where('statusorder', '=', "Gagal")
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, COUNT(statusorder) AS gagal'))
            ->pluck('gagal');

        $sukses = Customerlog::where('tgl', date('Y-m-d'))
            ->where('kdslm', '!=', "")
            // ->where('salesorder', '>=', 0)
            ->where('status', '=', 'Sukses')
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, COUNT(status) AS sukses'))
            ->pluck('sukses');

        // $sukses = Somobileheader::where('tgl', date('Y-m-d'))
        //     ->where('kdslm', '!=', "")
        //     ->groupBy(DB::raw("kdslm"))
        //     ->select(DB::raw('kdslm, COUNT(nobukti) AS sukses'))
        //     ->pluck('sukses');

        // SELECT kdslm, SUM(NETTO) AS sukses, COUNT(netto)
        // FROM somobileheader
        // WHERE tgl=CURDATE() AND netto != "0"
        // GROUP BY kdslm;

        $data['suksescard'] = Customerlog::where('tgl', date('Y-m-d'))
            ->where('kdslm', '!=', "")
            ->where('status', '=', "Sukses")
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, COUNT(status) AS suksescards'))
            // ->pluck('sukses');
            ->get();
        // dd($suksescard);
        // ->get();


        $callinput = Customerlog::where('tgl', date('Y-m-d'))
            ->where('kdslm', '!=', "")
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, COUNT(cekin) AS callinput'))
            ->pluck('callinput');

        $salesoutsalesman = Fakturjual::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->orderBy(DB::raw("kdslm"))
            ->where('kdslm', '!=', "")
            ->where('kdslm', '!=', "07")
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, SUM(Netto) AS salesoutsalesman'))
            ->pluck('salesoutsalesman');

        // ->get();
        // dd($salesoutsalesmanround);
        // $salesoutsalesman = round($salesoutsalesmanround);

        $sumsalesman = Fakturjual::join('salesman', 'fakturjualheader.kdslm', '=', 'salesman.kdslm')
            ->whereMonth("fakturjualheader.TglKirim", date('m'))
            ->whereYear("fakturjualheader.TglKirim", date('Y'))
            ->where('fakturjualheader.kdslm', '!=', "")
            ->where('fakturjualheader.kdslm', '!=', "07")
            ->orderBy(DB::raw("fakturjualheader.kdslm"))
            ->groupBy(DB::raw("salesman.NmSlm"))
            ->select(DB::raw('salesman.NmSlm as sumsalesman'))
            // ->select(
            //     DB::raw('(
            //         CASE
            //             WHEN kdslm = 01 THEN "JANAWIK"
            //             WHEN kdslm = 19 THEN "APRIYANTO"
            //             WHEN kdslm = 54 THEN "AWALUDIN"
            //             WHEN kdslm = 48 THEN "SUSI"
            //             WHEN kdslm = 41 THEN "KANTA"
            //             WHEN kdslm = 36 THEN "NOVI YANTI"
            //             WHEN kdslm = 34 THEN "AGUS"
            //             WHEN kdslm = 20 THEN "HASAN"
            //             WHEN kdslm = 32 THEN "HERMAN"
            //             WHEN kdslm = 25 THEN "KUSNADI"
            //             WHEN kdslm = 23 THEN "IRAWAN"
            //             WHEN kdslm = 44 THEN "EVA LUSITA"
            //             WHEN kdslm = 72 THEN "UMAR"
            //         ELSE "UNKNOW"
            //         END) AS sumsalesman')
            // )
            ->pluck('sumsalesman');
        // ->get('sumsalesman');
        // dd($sumsalesman);

        $salesmans = Customerlog::where('tgl', date('Y-m-d'))
            ->where('kdslm', '!=', "")
            ->groupBy(DB::raw("kdslm"))
            ->select(
                DB::raw('(
                    CASE
                        WHEN kdslm = 01 THEN "JANAWIK"
                        WHEN kdslm = 19 THEN "APRIYANTO"
                        WHEN kdslm = 54 THEN "AWALUDIN"
                        WHEN kdslm = 48 THEN "SUSI"
                        WHEN kdslm = 41 THEN "KANTA"
                        WHEN kdslm = 36 THEN "NOVI YANTI"
                        WHEN kdslm = 34 THEN "AGUS"
                        WHEN kdslm = 20 THEN "HASAN"
                        WHEN kdslm = 32 THEN "HERMAN"
                        WHEN kdslm = 25 THEN "KUSNADI"
                        WHEN kdslm = 23 THEN "IRAWAN"
                        WHEN kdslm = 44 THEN "EVA LUSITA"
                        WHEN kdslm = 72 THEN "UMAR"
                    ELSE "UNKNOW"
                    END) AS salesmans')
            )
            ->pluck('salesmans');

        $data['bullanfilterNname'] = Fakturjual::select(DB::raw("MONTHNAME(TglKirim) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(TglKirim)"))
            ->OrderBy(DB::raw("MONTH(TglKirim)"))
            ->whereYear("TglKirim", '2022')
            ->whereNotIn('TglKirim', ['null'])
            ->get();

        $data['yearfilter'] = Fakturjual::select(DB::raw("YEAR(TglKirim) as tahun"))
            ->GroupBy(DB::raw("YEAR(TglKirim)"))
            ->OrderBy(DB::raw("YEAR(TglKirim)"))
            ->whereNotIn('TglKirim', ['null'])
            ->get();
        // dd($bulan);

        $nilai = Fakturjual::where("stat", '6')
            ->GroupBy(DB::raw("MONTHNAME(TglKirim)"))
            ->select(DB::raw('SUM(Netto) as nilai'))
            ->OrderBy(DB::raw("MONTH(TglKirim)"))
            ->whereYear("TglKirim", date('Y'))
            ->pluck('nilai');

        $nilaireturs = ReturJual::where("stat", '6')
            ->GroupBy(DB::raw("MONTHNAME(TglKirim)"))
            ->select(DB::raw('SUM(Netto) as nilaireturs'))
            ->OrderBy(DB::raw("MONTH(TglKirim)"))
            ->whereYear("TglKirim", date('Y'))
            ->pluck('nilaireturs');


        $pieprincipal =  Hutang::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereNotIn('kdsupplier', ['k28'])
            ->groupBy(DB::raw("KdSupplier"))
            ->select(DB::raw('KdSupplier, SUM(netto) as NettoPrincipal'))
            ->get();

        $pieprincipalkd =  Hutang::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereNotIn('kdsupplier', ['k28'])
            ->groupBy(DB::raw("KdSupplier"))
            ->select(DB::raw('KdSupplier'))
            ->pluck('KdSupplier');

        setlocale(LC_TIME, 'id_ID.utf8');

        // //card faktur penjualan
        $data['penjaualndb22'] = Fakturjual::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->where("stat", '6')
            ->orwhere("stat", '2')
            ->count();

        $data['sumpenjualandb22'] = Fakturjual::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->where("stat",'!=', '4')
            ->where("stat",'!=', '1')
            // ->orwhere("stat", '2')
            ->sum('Netto');

        $data['fakturbatal'] = Fakturjual::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->where("stat", '4')
            ->sum('Netto');

        //card retur jual
        $data['countreturgeneral'] = ReturJual::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->where("stat", '6')
            ->count();

        $data['sumstretur'] = ReturJual::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->where("stat", '6')
            ->sum('Netto');

        //card Hutang
        $data['sumshutang'] = Hutang::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->where('kdsupplier', '!=', 'k28')
            ->sum('Netto');

        // sum per principal
        $data['sumshutangperprincipal'] = Hutang::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereNotIn('kdsupplier', ['k28'])
            ->groupBy(DB::raw("KdSupplier"))
            ->select(DB::raw('KdSupplier , SUM(netto) as sumprincipal'))
            ->get();
        // dd($datab);

        $data['sumshutangperprincipaltgl'] = Hutang::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereNotIn('kdsupplier', ['k28'])
            ->groupBy(DB::raw("KdSupplier, TglJTempo"))
            // ->orderBy(DB::raw("CASE WHEN TglJTempo >=CURRENT_DATE() THEN 'Hutang Masih Ada' END"))
            ->orderBy('TglJTempo', 'DESC')
            ->select(DB::raw('KdSupplier, TglJTempo, SUM(netto) as sumprincipaltgl, DATEDIFF(TglJTempo,CURRENT_DATE()) AS Jumlah_Haritgl'))
            ->get();
        // dd($datacs);

        //card Piutang
        $data['sumspiutang'] = Piutang::whereMonth("Tgl", date('m'))
            // ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereYear("Tgl", date('Y'))
            ->sum('Netto');

        $data['countshutang'] = Hutang::whereMonth("TglJTempo", '>=', date('m'))
            ->whereYear("TglJTempo", '>=', date('Y'))
            ->count();

        $data['countspiutang'] = Piutang::whereMonth("Tgl", date('m'))
            // ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereYear("Tgl", date('Y'))
            ->count();

        //soheader round count per sales
        $data['psales01'] = Soheader::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->groupBy(DB::raw("Kdslm"))
            ->select(DB::raw('Kdslm , SUM(netto) as sumb'))
            ->get();
        $data['sumsodaily'] = Soheader::where('tgl', date('Y-m-d'))
            ->sum('netto');

        // $data['sumsomonth'] = Soheader::whereMonth('tgl', date('m'))
        //     ->sum('netto');

        $data['sumreturbeli'] = ReturPembelian::whereMonth("tgl", date('m'))
            ->whereYear("tgl", date('Y'))
            ->sum('Netto');
        // $data['monthnamcontroller'] = Fakturjual::select(DB::raw("MONTH(TglKirim) as bulannomor, MONTHNAME(TglKirim) as namabulan"))
        //     ->GroupBy(DB::raw("MONTH(TglKirim), MONTHNAME(TglKirim)"))
        //     ->OrderBy(DB::raw("MONTH(TglKirim)"))
        //     ->whereYear("TglKirim", '2021')
        //     ->whereNotIn('TglKirim', ['null'])
        //     ->get();
        $data['countsales'] = Fakturjual::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            // ->where("stat", '6')
            ->groupBy(DB::raw("Kdslm"))
            ->select(DB::raw('Kdslm , COUNT(DISTINCT CustNo) as csales'))
            ->get();
        $data['sumsales'] = Fakturjual::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            // ->where("stat", '6')
            ->groupBy(DB::raw("Kdslm"))
            ->select(DB::raw('Kdslm, sum(Netto) as ecsum'))
            ->get();

        $data['salesmanall'] = Salesman::all();
        $data['targets'] = TargetSalesman::all();
        $data['supplier'] = Supplier::where('stat', '=', '1')->get();


        $stokK = StokKartu::where("mk", "k")
            ->whereYear("Tgl", date('Y'))
            ->select(DB::raw('SUM(hpp*qty) as stokk'))
            ->get();
        $stokM = StokKartu::where("mk", "m")
            ->whereYear("Tgl", date('Y'))
            ->select(DB::raw("SUM(hpp*qty) as stokm"))
            ->get();

        $arraystokk = $stokK[0]['stokk'];
        $arraystokm = $stokM[0]['stokm'];
        $totalkartustok = $arraystokm - $arraystokk;


        return view('dashboarddmj.dmj', ['detikused' => $detikused, 'plucksaldostokall99'=>$plucksaldostokall99, 'totalkartustok' => $totalkartustok, 'bulan' => $bulan, 'callinput' => $callinput, 'salesoutsalesman' => $salesoutsalesman, 'sumsalesman' => $sumsalesman, 'nilaireturs' => $nilaireturs, 'nilai' => $nilai, 'pieprincipal' => $pieprincipal, 'pieprincipalkd' => $pieprincipalkd, 'sukses' => $sukses, 'gagal' => $gagal, 'salesmans' => $salesmans], $data);
    }

    public function carimonthly(Request $request)
    {
        $saldostok99 = Stokbulan::join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
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

        $saldostok98 = Stokbulan::join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
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

        // $data['saldostokall'] = Stokbulan::innerjoin("barang", function ($join) {
        //     $join->on("stokbulan.kdbrg", "=", "barang.kdbrg");
        // })
        //     ->innerJoin("supplier", function ($join) {
        //         $join->on("supplier.kdsupplier", "=", "barang.kdsupplier")
        //             ->where("barang.stat", "!=", 2)
        //             ->where("supplier.kdsupplier", "!=", 'k21')
        //             ->where("supplier.kdsupplier", "!=", 'k24')
        //             ->where("supplier.kdsupplier", "!=", 'k30')
        //             ->where("supplier.kdsupplier", "!=", 'k31')
        //             ->where("supplier.kdsupplier", "!=", '99')
        //             ->where("stokbulan.tahun", "=", '2022');
        //     })
        //     ->select("stokbulan.tahun", "supplier.`namasupplier`", "stokbulan.nawal", "sum (stokbulan.nm1+stokbulan.nm2+stokbulan.nm3) as total_masuk", "sum (stokbulan.nk1+stokbulan.nk2+stokbulan.nk3) as total_keluar", "sum ((stokbulan.nm1+stokbulan.nm2+stokbulan.nm3)- (stokbulan.nk1+stokbulan.nk2+stokbulan.nk3) + nawal)as sisa_saldo")
        //     ->where("stokbulan.kdgudang", "=", '98')
        //     ->where("stokbulan.kdgudang", "=", '99')
        //     ->groupBy("barang")
        //     ->get();

        $arraysaldostok98 = $saldostok98[0]['Sisa_saldo98'];
        $arraysaldostok99 = $saldostok99[0]['Sisa_saldo99'];
        // dd($saldostok99);
        $data['totalsaldostok'] = $arraysaldostok98 + $arraysaldostok99;

        $plucksaldostokall99['saldostokall98'] = Stokbulan::select(
                DB::raw('SUM((stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3)-(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) + Nawal) AS Sisa_saldoall99')
            )->join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
            ->join('supplier', 'supplier.KdSupplier', '=', 'barang.KdSupplier')
            ->where('stokbulan.kdGudang', "99")
            ->where('stokbulan.tahun','2022')
            ->where('supplier.KdSupplier', '!=', "k21")
            ->where('supplier.KdSupplier', '!=', "k24")
            ->where('supplier.KdSupplier', '!=', "k30")
            ->where('supplier.KdSupplier', '!=', "k31")
            ->where('supplier.KdSupplier', '!=', "99")
            ->where('barang.Stat', '!=', "2")
            ->where('supplier.Stat', '!=', "2")
            // ->groupBy(DB::raw("supplier.KdSupplier"))
            ->groupBy("supplier.NamaSupplier")
            ->pluck('Sisa_saldoall99');

        $plucksaldostokall98['saldostokall98'] = Stokbulan::select(
                DB::raw('SUM((stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3)-(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) + Nawal) AS Sisa_saldoall98')
            )->join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
            ->join('supplier', 'supplier.KdSupplier', '=', 'barang.KdSupplier')
            ->where('stokbulan.kdGudang', "98")
            ->where('stokbulan.tahun','2022')
            ->where('supplier.KdSupplier', '!=', "k21")
            ->where('supplier.KdSupplier', '!=', "k24")
            ->where('supplier.KdSupplier', '!=', "k30")
            ->where('supplier.KdSupplier', '!=', "k31")
            ->where('supplier.KdSupplier', '!=', "99")
            ->where('barang.Stat', '!=', "2")
            ->where('supplier.Stat', '!=', "2")
            // ->groupBy(DB::raw("supplier.KdSupplier"))
            ->groupBy("supplier.NamaSupplier")
            ->pluck('Sisa_saldoall98');

        $data['saldostokall'] = Stokbulan::select(
                // DB::raw('supplier.KdSupplier'),
                DB::raw('supplier.NamaSupplier'),
                DB::raw('SUM(stokbulan.Nawal+0) AS Sadlo_awal'),
                DB::raw('SUM(stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3) AS Total_masuk'),
                DB::raw('SUM(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) AS Total_keluar'),
                DB::raw('SUM((stokbulan.Nm1+stokbulan.Nm2+stokbulan.Nm3)-(stokbulan.Nk1+stokbulan.Nk2+stokbulan.Nk3) + Nawal) AS Sisa_saldoall')
            )->join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
            ->join('supplier', 'supplier.KdSupplier', '=', 'barang.KdSupplier')

            ->where('stokbulan.tahun','2022')
            ->where('supplier.KdSupplier', '!=', "k21")
            ->where('supplier.KdSupplier', '!=', "k24")
            ->where('supplier.KdSupplier', '!=', "k30")
            ->where('supplier.KdSupplier', '!=', "k31")
            ->where('supplier.KdSupplier', '!=', "99")
            ->where('barang.Stat', '!=', "2")
            ->where('supplier.Stat', '!=', "2")
            ->where('stokbulan.kdGudang', "99")
            ->orwhere('stokbulan.kdGudang', "98")
            ->groupBy("supplier.NamaSupplier")
            ->get();
            
        $echodate23 = Carbon::parse($request->monthfilter)->month;
        // dd($echodate23);

        //card Piutang
        $data['sumsomonth'] = Soheader::whereMonth("tgl", $echodate23)
            ->whereYear("tgl", [$request->yearfilter])
            ->sum('netto');

        $data['sumreturbeli'] = ReturPembelian::whereMonth("tgl", $echodate23)
            ->whereYear("tgl", [$request->yearfilter])
            ->sum('Netto');
        $data['sumspiutang'] = Piutang::whereMonth("tgl", $echodate23)
            ->whereYear("tgl", [$request->yearfilter])
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->sum('Netto');
        $data['countspiutang'] = Piutang::whereYear("tgl", [$request->yearfilter])
            ->whereYear("tgl", [$request->yearfilter])
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->count();
        $data['penjaualndb22'] = Fakturjual::whereMonth("TglKirim", $echodate23)
            ->whereYear("TglKirim", [$request->yearfilter])
            ->where("stat", '2')
            ->count();
        $data['sumpenjualandb22'] = Fakturjual::whereMonth("TglKirim", $echodate23)
            ->whereYear("TglKirim", [$request->yearfilter])
            ->where("stat", '2')
            ->sum('Netto');

        $data['fakturbatal'] = Fakturjual::whereMonth("TglKirim", $echodate23)
            ->whereYear("TglKirim", [$request->yearfilter])
            ->where("stat", '4')
            ->sum('Netto');

        $data['countreturgeneral'] = ReturJual::whereMonth("TglKirim", $echodate23)
            ->whereYear("TglKirim", [$request->yearfilter])
            ->where("stat", '6')
            ->count();

        $data['sumstretur'] = ReturJual::whereMonth("TglKirim", $echodate23)
            ->whereYear("TglKirim", [$request->yearfilter])
            ->where("stat", '6')
            ->sum('Netto');

        $data['countsales'] = Fakturjual::whereMonth("TglKirim", $echodate23)
            ->whereYear("TglKirim", [$request->yearfilter])
            ->groupBy(DB::raw("Kdslm"))
            ->select(DB::raw('Kdslm , COUNT(DISTINCT CustNo) as csales'))
            ->get();

        $data['sumsales'] = Fakturjual::whereMonth("TglKirim", $echodate23)
            ->whereYear("TglKirim", [$request->yearfilter])
            ->groupBy(DB::raw("Kdslm"))
            ->select(DB::raw('Kdslm, sum(Netto) as ecsum'))
            ->get();

        $bulan = Fakturjual::select(DB::raw("MONTHNAME(TglKirim) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(TglKirim)"))
            ->OrderBy(DB::raw("MONTH(TglKirim)"))
            ->whereYear("TglKirim", '2021')
            ->whereNotIn('TglKirim', ['null'])
            ->pluck('bulan');

        $data['custlogs1'] = Customerlog::where('tgl', date('Y-m-d'))
            ->where('cekin', '!=', NULL)
            ->where('kdslm', '!=', "")
            ->select(DB::raw('*, TIMEDIFF(cekout, cekin) AS used_time'))
            ->get();

        $data['custlogs2'] = Customerlog::join('salesman', 'customer_log.kdslm', '=', 'salesman.kdslm')
            ->where('customer_log.tgl', date('Y-m-d'))
            ->where('customer_log.cekin', '!=', NULL)
            ->where('customer_log.kdslm', '!=', "")
            ->orderBy(DB::raw("salesman.kdslm"))
            ->groupBy(DB::raw("salesman.NmSlm"))
            ->select(
                DB::raw('salesman.NmSlm as salesmans'),
                DB::raw('MIN(customer_log.cekin) AS firstcekin'),
                DB::raw('COUNT(customer_log.cekin) AS callinputcard'),
                DB::raw('COUNT(customer_log.status) AS suksescard'),
                DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(customer_log.cekout) - TIME_TO_SEC(cekin))) AS used_time'),
                // DB::raw('SUM(TIME_TO_SEC(cekout) - TIME_TO_SEC(cekin) AS used_sec'),
                DB::raw('SUM(TIME_TO_SEC(customer_log.cekout) - TIME_TO_SEC(cekin))/23600*100 AS used_sec'),
                // DB::raw('SUM(TIME_TO_SEC(cekout) - TIME_TO_SEC(cekin))/18000*100 AS used_sec'),
                DB::raw('SUM(customer_log.salesorder) AS penjualan')
            )
            ->get();


        $saldostok99 = Stokbulan::join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
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

        $saldostok98 = Stokbulan::join('barang', 'stokbulan.kdbrg', '=', 'barang.kdbrg')
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
        // dd($saldostok99);
        $data['totalsaldostok'] = $arraysaldostok98 + $arraysaldostok99;

        $detikused = Customerlog::where('tgl', date('Y-m-d'))
            ->where('statusorder', '!=', NULL)
            ->where('kdslm', '!=', "")
            // ->select(DB::raw('kdslm, TIMEDIFF(cekout, cekin) AS used_time'))
            ->select(
                DB::raw('SUM(TIME_TO_SEC(cekout) - TIME_TO_SEC(cekin)) AS detikused')
            )
            ->groupBy(DB::raw("kdslm"))
            ->pluck('detikused');

        $gagal = Customerlog::where('tgl', date('Y-m-d'))
            ->where('statusorder', '=', "Gagal")
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, COUNT(statusorder) AS gagal'))
            ->pluck('gagal');

        $sukses = Customerlog::where('tgl', date('Y-m-d'))
            ->where('kdslm', '!=', "")
            // ->where('salesorder', '>=', 0)
            ->where('status', '=', 'Sukses')
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, COUNT(status) AS sukses'))
            ->pluck('sukses');
        // $sukses = Somobileheader::where('tgl', date('Y-m-d'))
        //     ->where('kdslm', '!=', "")
        //     ->groupBy(DB::raw("kdslm"))
        //     ->select(DB::raw('kdslm, COUNT(nobukti) AS sukses'))
        //     ->pluck('sukses');

        // dd($sukses);

        $data['suksescard'] = Customerlog::where('tgl', date('Y-m-d'))
            ->where('kdslm', '!=', "")
            ->where('status', '=', "Sukses")
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, COUNT(status) AS suksescards'))
            // ->pluck('sukses');
            ->get();
        // dd($suksescard);
        // ->get();

        $callinput = Customerlog::where('tgl', date('Y-m-d'))
            ->where('kdslm', '!=', "")
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, COUNT(cekin) AS callinput'))
            ->pluck('callinput');

        //     ->get();
        // dd($callinput);
        // dd($sukses);
        $salesmans = Customerlog::where('tgl', date('Y-m-d'))
            ->where('kdslm', '!=', "")
            ->groupBy(DB::raw("kdslm"))
            // ->select(DB::raw('kdslm as salesmans'))
            ->select(
                DB::raw('(
                    CASE
                        WHEN kdslm = 01 THEN "JANAWIK"
                        WHEN kdslm = 19 THEN "APRIYANTO"
                        WHEN kdslm = 54 THEN "AWALUDIN"
                        WHEN kdslm = 48 THEN "SUSI"
                        WHEN kdslm = 41 THEN "KANTA"
                        WHEN kdslm = 36 THEN "NOVI YANTI"
                        WHEN kdslm = 34 THEN "AGUS"
                        WHEN kdslm = 20 THEN "HASAN"
                        WHEN kdslm = 32 THEN "HERMAN"
                        WHEN kdslm = 25 THEN "KUSNADI"
                        WHEN kdslm = 23 THEN "IRAWAN"
                        WHEN kdslm = 44 THEN "EVA LUSITA"
                        WHEN kdslm = 72 THEN "UMAR"
                    ELSE "UNKNOW"
                    END) AS salesmans')
            )
            ->pluck('salesmans');
        $salesoutsalesman = Fakturjual::whereMonth("TglKirim", [$request->$echodate23])
            ->whereYear("TglKirim", [$request->yearfilter])
            ->orderBy(DB::raw("kdslm"))
            ->where('kdslm', '!=', "")
            ->where('kdslm', '!=', "07")
            ->groupBy(DB::raw("kdslm"))
            ->select(DB::raw('kdslm, SUM(Netto) AS salesoutsalesman'))
            ->pluck('salesoutsalesman');
        // ->get();
        // dd($salesoutsalesman);

        $sumsalesman = Fakturjual::whereMonth("TglKirim", [$request->$echodate23])
            ->whereYear("TglKirim", [$request->yearfilter])
            ->where('kdslm', '!=', "")
            ->where('kdslm', '!=', "07")
            ->orderBy(DB::raw("kdslm"))
            ->groupBy(DB::raw("kdslm"))
            ->select(
                DB::raw('(
                    CASE
                        WHEN kdslm = 01 THEN "JANAWIK"
                        WHEN kdslm = 19 THEN "APRIYANTO"
                        WHEN kdslm = 54 THEN "AWALUDIN"
                        WHEN kdslm = 48 THEN "SUSI"
                        WHEN kdslm = 41 THEN "KANTA"
                        WHEN kdslm = 36 THEN "NOVI YANTI"
                        WHEN kdslm = 34 THEN "AGUS"
                        WHEN kdslm = 20 THEN "HASAN"
                        WHEN kdslm = 32 THEN "HERMAN"
                        WHEN kdslm = 25 THEN "KUSNADI"
                        WHEN kdslm = 23 THEN "IRAWAN"
                        WHEN kdslm = 44 THEN "EVA LUSITA"
                        WHEN kdslm = 72 THEN "UMAR"
                    ELSE "UNKNOW"
                    END) AS sumsalesman')
            )
            ->pluck('sumsalesman');

        $data['bullanfilterNname'] = Fakturjual::select(DB::raw("MONTHNAME(TglKirim) as bulan"))
            ->GroupBy(DB::raw("MONTHNAME(TglKirim)"))
            ->OrderBy(DB::raw("MONTH(TglKirim)"))
            ->whereYear("TglKirim", '2022')
            ->whereNotIn('TglKirim', ['null'])
            ->get();

        $data['yearfilter'] = Fakturjual::select(DB::raw("YEAR(TglKirim) as tahun"))
            ->GroupBy(DB::raw("YEAR(TglKirim)"))
            ->OrderBy(DB::raw("YEAR(TglKirim)"))
            ->whereNotIn('TglKirim', ['null'])
            ->get();
        // dd($bulan);

        $nilai = Fakturjual::where("stat", '6')
            ->GroupBy(DB::raw("MONTHNAME(TglKirim)"))
            ->select(DB::raw('SUM(Netto) as nilai'))
            ->OrderBy(DB::raw("MONTH(TglKirim)"))
            ->whereYear("TglKirim", [$request->yearfilter])
            // ->whereYear("TglKirim", date('Y'))
            ->pluck('nilai');

        $nilaireturs = ReturJual::where("stat", '6')
            ->GroupBy(DB::raw("MONTHNAME(TglKirim)"))
            ->select(DB::raw('SUM(Netto) as nilaireturs'))
            ->OrderBy(DB::raw("MONTH(TglKirim)"))
            ->whereYear("TglKirim", date('Y'))
            ->pluck('nilaireturs');


        $pieprincipal =  Hutang::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereNotIn('kdsupplier', ['k28'])
            ->groupBy(DB::raw("KdSupplier"))
            ->select(DB::raw('KdSupplier, SUM(netto) as NettoPrincipal'))
            ->get();

        $pieprincipalkd =  Hutang::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereNotIn('kdsupplier', ['k28'])
            ->groupBy(DB::raw("KdSupplier"))
            ->select(DB::raw('KdSupplier'))
            ->pluck('KdSupplier');

        setlocale(LC_TIME, 'id_ID.utf8');

        // //card faktur penjualan


        //card Hutang
        $data['sumshutang'] = Hutang::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->where('kdsupplier', '!=', 'k28')
            ->sum('Netto');

        // sum per principal
        $data['sumshutangperprincipal'] = Hutang::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereNotIn('kdsupplier', ['k28'])
            ->groupBy(DB::raw("KdSupplier"))
            ->select(DB::raw('KdSupplier , SUM(netto) as sumprincipal'))
            ->get();
        // dd($datab);

        $data['sumshutangperprincipaltgl'] = Hutang::whereRaw("DATE_FORMAT(TglJTempo, '%Y-%m') >= ?", date('Y-m'))
            ->whereRaw('DATEDIFF(TglJTempo,CURRENT_DATE()) >= ?', '0')
            ->whereNotIn('kdsupplier', ['k28'])
            ->groupBy(DB::raw("KdSupplier, TglJTempo"))
            // ->orderBy(DB::raw("CASE WHEN TglJTempo >=CURRENT_DATE() THEN 'Hutang Masih Ada' END"))
            ->orderBy('TglJTempo', 'DESC')
            ->select(DB::raw('KdSupplier, TglJTempo, SUM(netto) as sumprincipaltgl, DATEDIFF(TglJTempo,CURRENT_DATE()) AS Jumlah_Haritgl'))
            ->get();
        // dd($datacs);

        $data['countshutang'] = Hutang::whereMonth("TglJTempo", '>=', date('m'))
            ->whereYear("TglJTempo", '>=', date('Y'))
            ->count();

        //soheader round count per sales
        $data['psales01'] = Soheader::whereMonth("TglKirim", date('m'))
            ->whereYear("TglKirim", date('Y'))
            ->groupBy(DB::raw("Kdslm"))
            ->select(DB::raw('Kdslm , SUM(netto) as sumb'))
            ->get();

        $data['sumsodaily'] = Soheader::where('tgl', date('Y-m-d'))
            ->sum('netto');

        $data['salesmanall'] = Salesman::all();
        // dd($datask);
        $data['targets'] = TargetSalesman::all();
        $data['supplier'] = Supplier::where('stat', '=', '1')->get();

        $stokK = StokKartu::where("mk", "k")
            ->select(DB::raw('SUM(hpp*qty) as stokk'))
            ->get();
        $stokM = StokKartu::where("mk", "m")
            ->select(DB::raw("SUM(hpp*qty) as stokm"))
            ->get();

        $arraystokk = $stokK[0]['stokk'];
        $arraystokm = $stokM[0]['stokm'];
        $totalkartustok = $arraystokm - $arraystokk;
        // dd($request);
        return view('dashboarddmj.dmj', ['detikused' => $detikused, 'totalkartustok' => $totalkartustok, 'detikused' => $detikused, 'bulan' => $bulan, 'callinput' => $callinput, 'salesoutsalesman' => $salesoutsalesman, 'sumsalesman' => $sumsalesman, 'nilaireturs' => $nilaireturs, 'nilai' => $nilai, 'pieprincipal' => $pieprincipal, 'pieprincipalkd' => $pieprincipalkd, 'sukses' => $sukses, 'gagal' => $gagal, 'salesmans' => $salesmans], $data);
    }
}
