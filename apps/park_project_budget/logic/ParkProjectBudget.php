<?php
// park_project_budget模块逻辑层

namespace app\park_project_budget\logic;

use app\common\logic\Base as BaseLogic;

class ParkProjectBudget extends BaseLogic
{
    public function formExtraHtml()
    {
        return <<<EOF
            <script type="text/javascript">
                $(function() {
                  $("input").keyup(function() {
                   sum();
                  })
                });
                function sum() {
                  var num9=$("[name=amount]").val();
                   var num10=$("[name=material_cost]").val();
                   var num11=$("[name=test_processing_cost]").val();
                   var num12=$("[name=fuel_cost]").val();
                   var num13=$("[name=business_cost]").val();
                   var num14=$("[name=knowledge_cost]").val();
                   var num15=$("[name=service_cost]").val();
                   var num16=$("[name=advisory_cost]").val();
                   var num17=$("[name=other_cost]").val();
                   //var sum = parseInt(num9)-parseInt(num10)-parseInt(num11)-parseInt(num12)-parseInt(num13)-parseInt(num14)-parseInt(num15)-parseInt(num16)-parseInt(num17);
                   var sum = num9-num10-num11-num12-num13-num14-num15-num16-num17;
                   $("[name=balance]").css('color','red').val(sum);
                };
            </script>
EOF;

    }
}
