$(document).ready(function()
{
    $('[name^=objectType]').change(function()
    {
        var objectType = $(this).val();
        var checked    = $(this).prop('checked');
        if(objectType != 'project')
        {
            if(checked)
            {
                $('[name^=objectType]').not(this).not('[value=project]').prop('checked', false).change();
            }
            if(objectType == 'order')    $('#customer').parents('tr').toggle(checked);
            if(objectType == 'contract') $('#customer').parents('tr').toggle(checked);
        }
        $('#' + objectType).parents('tr').toggle(checked);
    });

    /* show or hide detail. */
    $(document).on('click', '.detail', function()
    {
        if($(this).find('i').hasClass('icon-double-angle-down'))
        {
            $('input[name^=dateList]').each(function()
            {
                if(!($this).val()) $(this).val($('#date').val());
            }
            $('select[name^=categoryList]').each(function()
            {
                if(!$(this).val()) $(this).val($('#category').val()).trigger('chosen:updated');
            });
            $('select[name^=relatedList]').each(function()
            {
                if(!$(this).val()) $(this).val($('#related').val()).trigger('chosen:updated');
            });
            $('textarea[name^=descList]').each(function()
            {
                if(!$(this).val()) $(this).val($('#desc').val());
            }

            $('#refund-detail').removeClass('hidden');
            $('#money').prop('readonly', 'readonly');
            $('#refund-date').addClass('hidden');
            $('#refund-related').addClass('hidden');
            $(this).find('i').removeClass('icon-double-angle-down');
            $(this).find('i').addClass('icon-double-angle-up');
        }
        else
        {
            $('input[name^=moneyList]').val('');
            $('#refund-detail').addClass('hidden');
            $('#money').prop('readonly', '');
            $('#refund-date').removeClass('hidden');
            $('#refund-related').removeClass('hidden');
            $(this).find('i').removeClass('icon-double-angle-up');
            $(this).find('i').addClass('icon-double-angle-down');
        }
        return false;
    });

    /* update money. */
    function updateMoney()
    {
        var money = 0;
        $('input[name^=moneyList]').each(function()
        {
            if($.isNumeric($(this).val()))
            {
                money += parseFloat($(this).val());
            }
        });
        money = Math.round(money * 100) / 100;
        $('#money').val(money);
        return false;
    }
    $('input[name^=moneyList]').change(updateMoney);

    /* Add a trade detail item. */
    $(document).on('click', '.table-detail .icon-plus', function()
    {
        var tr = $(this).closest('tr');
        tr.after($('#detailTpl').html().replace(/key/g, v.key));
        tr.next().find('input[name^=dateList]').val($('#date').val()).fixedDate().datetimepicker($.extend(window.datetimepickerDefaultOptions, {eleClass:'', minView: 2, maxView: 1, format: 'yyyy-mm-dd'}));
        tr.next().find('select[name^=categoryList]').val($('#category').val()).chosen(window.chosenDefaultOptions);
        tr.next().find('select[name^=relatedList]').val($('#related').val()).chosen(window.chosenDefaultOptions);
        tr.next().find('textarea[name^=descList]').val($('#desc').val());
        $('input[name^=moneyList]').change(updateMoney);
        v.key++;
        return false;
    });

    /* Remove a trade detail item. */
    $(document).on('click', '.table-detail .icon-remove', function()
    {
        if($('#detailBox tr').size() > 1)
        {
            $(this).closest('tr').remove();
        }
        else
        {
            $(this).closest('tr').find('input,select').val('');
        }
        $('input[name^=moneyList]').change();
        return false;
    });

    if($('#detailBox tr').size() > 1)
    {
        $('.detail').click();
    }

    $('[name^=objectType]').each(function()
    {
        $('#' + $(this).val()).parents('tr').hide();
    });

    $('[name^=objectType]').each(function()
    {
        if($(this).prop('checked')) $(this).change();
    });
});

function getOrders(customer)
{
    if(!customer) return false;

    $('#order').load(createLink('crm.order', 'ajaxGetOrders', 'customer=' + customer), function()
    {
        $('#order').trigger('chosen:updated');
    });
}

function getContracts(customer)
{
    if(!customer) return false;

    $('#contract').load(createLink('crm.contract', 'getOptionMenu', 'customer=' + customer), function()
    {
        $('#contract').trigger('chosen:updated');
    });
}
