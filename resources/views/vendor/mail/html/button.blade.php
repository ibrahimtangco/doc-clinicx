@props(['url', 'color' => 'primary', 'align' => 'center'])
<table align="{{ $align }}" cellpadding="0" cellspacing="0" class="action" role="presentation" width="100%">
	<tr>
		<td align="{{ $align }}">
			<table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
				<tr>
					<td align="{{ $align }}">
						<table border="0" cellpadding="0" cellspacing="0" role="presentation">
							<tr>
								<td>
									<a class="button button-{{ $color }}" href="{{ $url }}" rel="noopener"
										target="_blank">{{ $slot }}</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
