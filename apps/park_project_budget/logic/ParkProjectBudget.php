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

    /**
     * @return string
     * 动态返回新增预算执行页面需要的数据
     */
    public function getProjectInfo()
    {
        return <<<EEE
<script type="text/javascript">
$("#project_name").change(function() {
  var project_id = $(this).val();
  var url = "/admin.php/park_project_budget/budget/projectInfo";
  $.ajax({
  url:url,
  type:'POST',
  dataType:'json',
  data:{
      project_id:project_id
  },
  success:function(data) {
      var obj = data.data;
      obj=JSON.stringify(obj);
      localStorage.setItem('projectData',obj);
      var pData = JSON.parse(localStorage.getItem('projectData'));
    $("[name=project_numbering]").val(pData.project_number);
    $("[name=project_category]").val(pData.type);
    $("[name=project_status]").val(pData.project_status);
  }
  })
});

$("#category").change(function() {
     var pData = JSON.parse(localStorage.getItem('projectData'));
     var cid = parseInt($(this).val());
    switch (cid) {
      case 1:
          $("[name=amount]").val(pData.equipment_cost);
          break;
      case 3:
          $("[name=amount]").val(pData.material_cost);
          break;
      case 4:
          $("[name=amount]").val(pData.test_processing_cost);
          break;
      case 5:
          $("[name=amount]").val(pData.fuel_cost);
          break;
      case 6:
          $("[name=amount]").val(pData.business_cost);
          break;
      case 7:
          $("[name=amount]").val(pData.knowledge_cost);
          break;
      case 8:
          $("[name=amount]").val(pData.service_cost);
          break;
      case 9:
          $("[name=amount]").val(pData.advisory_cost);
          break;
      case 10:
          $("[name=amount]").val(pData.other_cost);
          break;
      default:
          $("[name=amount]").val(0.00);
    };
})
</script>
EEE;
    }
}
