<?php

namespace App\Providers;

use App\Models\SettingModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Carbon\Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        
        // Ensure columns exist before update
        $newColumns = [
            'nama_kasi_pemerintahan', 'nip_kasi_pemerintahan',
            'nama_kasi_pembangunan', 'nip_kasi_pembangunan',
            'nama_kasi_pelayanan', 'nip_kasi_pelayanan',
            'nama_sekretaris', 'nip_sekretaris',
            'babinsa', 'bhabinkamtibmas', 'blpkb',
            'staf_pemerintahan', 'nip_staf_pemerintahan'
        ];
        
        foreach($newColumns as $col) {
            if (!\Illuminate\Support\Facades\Schema::hasColumn('setting', $col)) {
                \Illuminate\Support\Facades\Schema::table('setting', function (\Illuminate\Database\Schema\Blueprint $table) use ($col) {
                    $table->string($col)->nullable();
                });
            }
        }

        // Set Kelurahan data from images
        \Illuminate\Support\Facades\DB::table('setting')->where('id', 1)->update([
            'namalurah' => 'SALMAN AL FARISYI, ST',
            'nip' => '198104042009031007',
            'nama_kasi_pemerintahan' => 'ERY DESWIOTA, S.Sos',
            'nip_kasi_pemerintahan' => '197012231996032001',
            'nama_kasi_pelayanan' => 'SYAFNIARTI, S.Sos',
            'nip_kasi_pelayanan' => '198309222003122002',
            'nama_sekretaris' => '-',
            'nip_sekretaris' => '-',
            'babinsa' => 'INDRA. K',
            'bhabinkamtibmas' => 'ENDANG. S',
            'blpkb' => 'ERWIN',
            'staf_pemerintahan' => 'MIZWAN, S.Sos',
            'nip_staf_pemerintahan' => '196711121998101001'
        ]);

        $globalSetting = SettingModel::where('id', 1)->first();

        View::share('globalSetting', $globalSetting);
    }
}
