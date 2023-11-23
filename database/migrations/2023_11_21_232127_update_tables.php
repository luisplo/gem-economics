<?php

use App\Models\CompleteActivity;
use App\Models\Interval;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('rewards', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('intervals', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('complete_activities', function (Blueprint $table) {
            $table->integer('init_value')->before('value')->default(0);
        });
        $completeActivity = CompleteActivity::all();
        $completeActivity->map(function ($item) {
            $activityValue = $item->activity->value;
            $item->init_value = $activityValue;
            if ($activityValue == $item->value && $item->disabled) {
                $item->value = 0;
            }
            $item->update();
        });
        Schema::table('complete_activities', function (Blueprint $table) {
            $table->dropColumn('disabled');
        });
        Schema::table('complete_rewards', function (Blueprint $table) {
            $table->dropColumn('disabled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('rewards', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('intervals', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('complete_activities', function (Blueprint $table) {
            $table->boolean('disabled')->default(false)->after('value');
            $table->dropColumn('init_value');
        });
        Schema::table('complete_rewards', function (Blueprint $table) {
            $table->boolean('disabled')->default(false)->after('value');
        });
    }
};
