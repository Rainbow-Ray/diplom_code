<tr>
    <td class="tItemName"><input type='text' name='itemCheck[].Key' class='hide check {{ $prefix . $id }}' id='item {{ $prefix . $id }}'
            value='{{ $value }}' readonly>
        <input type='text' name='itemCheck[].Value' class='countEi hide {{ $prefix . $id }}'
            value='{{ $item->count }}|{{ $item->ei->id }}'>

        {{ $name }}
    </td>
    @if($isPurchased)
      
    <td class="tItemCount">  {{ is_null($item->countPurchased)  ? 0 : $item->countPurchased}} / {{ $item->count }}</td>
    <td class="tItemPrice"></td>
    @else 
    <td class="tItemCount"> {{ $item->count }}</td>
    @endif
</tr>
