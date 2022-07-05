<div class="panel">
    <table width='100%' border='1' class="table">
        <thead>
            <tr>
                <th>{l s='ID Order' mod='presslytask'}</th>
                <th>{l s='Order reference' mod='presslytask'}</th>
                <th>{l s='Customer' mod='presslytask'}</th>
                <th>{l s='Order value' mod='presslytask'}</th>
                <th>{l s='Order date' mod='presslytask'}</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$expensiveOrders item=expensiveOrdersRow}
                <tr>
                    <td>{$expensiveOrdersRow['id_order']}</td>
                    <td>{$expensiveOrdersRow['reference']}</td>
                    <td>{$expensiveOrdersRow['customer']}</td>
                    <td>{$expensiveOrdersRow['total_paid_tax_incl']}</td>
                    <td>{$expensiveOrdersRow['date_add']}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</div>



