<?php
// park_project_budget模块逻辑层

namespace app\park_project_budget\logic;

use app\common\logic\Base as BaseLogic;

/**
 * Class ParkProjectBudget
 * @package app\park_project_budget\logic
 * 项目预算逻辑层
 */
class ParkProjectBudget extends BaseLogic
{
    /**
     * @return string
     * 返回计算余额的js代码
     */
    public function formExtraHtml()
    {
        return <<<EOF
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/3.16.0/math.min.js"></script>
            <script type="text/javascript">
                $(function() {
                  $("input").keyup(function() {
                   sum();
                  })
                });
                function sum() {
                   var num9=$("[name=amount]").val();
                   var num10=parseFloat($("[name=material_cost]").val()).toFixed(2);
                   var num11=parseFloat($("[name=test_processing_cost]").val()).toFixed(2);
                   var num12=parseFloat($("[name=fuel_cost]").val()).toFixed(2);
                   var num13=parseFloat($("[name=business_cost]").val()).toFixed(2);
                   var num14=parseFloat($("[name=knowledge_cost]").val()).toFixed(2);
                   var num15=parseFloat($("[name=service_cost]").val()).toFixed(2);
                   var num16=parseFloat($("[name=advisory_cost]").val()).toFixed(2);
                   var num17=parseFloat($("[name=other_cost]").val()).toFixed(2);
                   var num18 = parseFloat($("[name=equipment_cost]").val()).toFixed(2);
                   var reslut = math.format(math.chain(math.bignumber(num9)).subtract(math.bignumber(num10)).subtract(math.bignumber(num11)).subtract(math.bignumber(num12)).subtract(math.bignumber(num13)).subtract(math.bignumber(num14)).subtract(math.bignumber(num15)).subtract(math.bignumber(num16)).subtract(math.bignumber(num17)).subtract(math.bignumber(num18)).done());
                   let num = new Number(reslut);
                   if (isNaN(num)){
                       num=0;
                   } 
                   $("[name=balance]").css('color','red').val(num);
                };
            </script>
EOF;

    }
}
