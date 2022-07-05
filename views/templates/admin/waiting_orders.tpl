<div class="panel">
    <table class="table" width="100%" border="1">
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
            {foreach from=$waitingOrders item=waitingOrdersRow}
                <tr>
                    <td>{$waitingOrdersRow['id_order']}</td>
                    <td>{$waitingOrdersRow['reference']}</td>
                    <td>{$waitingOrdersRow['customer']}</td>
                    <td>{$waitingOrdersRow['total_paid_tax_incl']}</td>
                    <td>{$waitingOrdersRow['date_add']}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</div>