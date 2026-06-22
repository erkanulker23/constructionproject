@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (app(\App\Settings\GeneralSettings::class)->header_logo)
<img
    src="{{ url(\Illuminate\Support\Facades\Storage::url(app(\App\Settings\GeneralSettings::class)->header_logo)) }}"
    class="logo"
    alt="{{ app(\App\Settings\GeneralSettings::class)->site_name }}"
>
@else
{{ app(\App\Settings\GeneralSettings::class)->site_name }}
@endif
</a>
</td>
</tr>
