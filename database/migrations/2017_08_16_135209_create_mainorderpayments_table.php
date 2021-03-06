<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainOrderPaymentsTable extends Migration 
{
	public function up()
	{
		Schema::create('main_order_payments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('pay_id', 30)->index();
            $table->integer('add_time')->index();
            $table->string('pay_sn', 30)->comment('支付单号');
            $table->float('quehuo')->default('0.00')->nullable()->comment('缺货金额');
            $table->float('jushou')->default('0.00')->nullable()->comment('拒收金额');
            $table->float('shifa')->default('0.00')->nullable()->comment('实发金额');
            $table->float('qiandan')->default('0.00')->nullable()->comment('签单金额');
            $table->float('ziti')->default('0.00')->nullable()->comment('自提金额');
            $table->float('qita')->default('0.00')->nullable()->comment('其他金额');
            $table->float('weicha')->default('0.00')->nullable()->comment('尾差');
            $table->string('desc_remark')->default('')->nullable()->comment('扣减备注');
            $table->float('yingshou')->default('0.00')->nullable()->comment('应收金额');
            $table->float('pos')->default('0.00')->nullable()->comment('pos刷卡');
			$table->string('out_pay_sn')->default('')->nullable()->comment('扣减备注');
            $table->float('weixin')->default('0.00')->nullable()->comment('微信');
            $table->float('alipay')->default('0.00')->nullable()->comment('支付宝');
            $table->float('yizhifu')->default('0.00')->nullable()->comment('翼支付');
            $table->float('cash')->default('0.00')->nullable()->comment('现金');
            $table->float('shishou')->default('0.00')->nullable()->comment('实收金额');
            $table->float('delivery_fee')->default('0.00')->nullable()->comment('配送费：运费+拆包');
            $table->float('driver_fee')->default('0.00')->nullable()->comment('司机费用');
            $table->unsignedInteger('second_driver_id')->nullable()->comment('有二次配送的话，该id为首次配送司机id');
            $table->unsignedInteger('jk_driver_id')->nullable()->comment('交款司机:为首次或者第二次送货司机');
            $table->timestamp('jk_at')->nullable()->comment('交款时间');
            $table->timestamp('ck_at')->nullable()->comment('存款时间');
            $table->string('remark')->default('')->nullable()->comment('备注');
            $table->boolean('status')->nullable()->default('0')->index()->comment('状态：0 已录入, 1已记账');
            $table->string('jlr', 20)->nullable()->default('')->comment('记录人');
            $table->string('jzr', 20)->nullable()->default('')->comment('记账人');
            $table->timestamp('jz_at')->nullable()->comment('记账时间');
            $table->string('updater', 20)->nullable()->default('')->comment('变更人');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('main_order_payments');
	}
}
