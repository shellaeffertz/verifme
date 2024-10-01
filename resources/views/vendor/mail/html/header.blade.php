<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('./assets/logo3.png') }}" class="logo" alt="Verifme Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
