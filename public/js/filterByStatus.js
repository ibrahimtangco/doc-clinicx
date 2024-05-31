$(document).ready(function() {
	$('#status').change(function() {
		var status = $(this).val();
		$.ajax({
			url: "/appointments/filter",
			type: 'GET',
			data: {
				status: status
				},
			success: function(response) {
				// Clear table body
				$('.all-appointments').empty();
				// Check if response is an array
				if (Array.isArray(response)) {
					//Append filtered appointments
					response.forEach(function(appointment) {
						var middleName = appointment.user.middle_name;
						var middleInitial = middleName ? middleName.charAt(0)
							.toUpperCase() + '.' : '';

						var date = new Date(appointment.date);
						var options = {
							year: 'numeric',
							month: 'long',
							day: 'numeric'
							};
						var formattedDate = date.toLocaleDateString('en-US',
							options);

						var timeString = appointment
						.time; // Assuming appointment.time is in format "HH:MM"
						var timeParts = timeString.split(
						':'); // Split the time string into hours and minutes
						var hours = parseInt(timeParts[
						0]); // Extract hours from the time string
						var minutes = parseInt(timeParts[
						1]); // Extract minutes from the time string

						// Determine AM/PM
						var ampm = hours >= 12 ? 'PM' : 'AM';

						// Convert hours to 12-hour format
						hours = hours % 12;
						hours = hours ? hours :
						12; // Handle noon (12:00) and midnight (00:00)

						// Add leading zero to minutes if less than 10
									minutes = minutes < 10 ? '0' + minutes : minutes;

						// Construct the formatted time string
						var formattedTime = hours + ':' + minutes + ' ' + ampm;


						var status = appointment.status;
						var statusClass, statusText;
						if (status == 'booked') {
							statusClass = 'text-yellow-500';
							statusText = 'Booked';
						} else if (status == 'cancelled') {
							statusClass = 'text-red-500';
							statusText = 'Cancelled';
						} else if (status == 'completed') {
							statusClass = 'text-green-500';
							statusText = 'Completed';
						} else {
							statusClass = ''; // Define default class if needed
							statusText =
								status; // Display status as it is if not matched with any condition
						}

						var statusSpan = '<span class="' + statusClass +
							' px-2 py-0.5 rounded-full">' + statusText + '</span>';
						var row = `
                                <tr class="odd:bg-white even:bg-gray-100 border-b font-medium">
						        <th class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap" scope="row">
							${appointment.user.first_name} ${middleInitial} ${appointment.user.last_name }
						</th>
						<td class="px-6 py-4">
                            ${appointment.service.name}
						</td>
						<td class="px-6 py-4">
							${formattedDate}
						</td>
						<td class="px-6 py-4">
							${formattedTime}
						</td>
						<td class="px-6 py-4 font-semibold">
							${statusSpan}
						</td>
						<td class="px-6 py-4 flex flex-col gap-1 xl:block xl:space-x-1">
							<a
								class="font-medium text-center text-white hover:bg-blue-700 bg-blue-600 px-3 py-1 rounded-lg flex items-center justify-center gap-1 w-fit"
								href="edit-appointment/${appointment.id}">
								<?xml version="1.0" ?><svg height="15px" version="1.1" viewBox="0 0 18 18" width="15px"
									xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink"
									xmlns="http://www.w3.org/2000/svg">
									<title />
									<desc />
									<defs />
									<g fill-rule="evenodd" fill="none" id="Page-1" stroke-width="1" stroke="none">
										<g fill="currentColor" id="Core" transform="translate(-213.000000, -129.000000)">
											<g id="create" transform="translate(213.000000, 129.000000)">
												<path
													d="M0,14.2 L0,18 L3.8,18 L14.8,6.9 L11,3.1 L0,14.2 L0,14.2 Z M17.7,4 C18.1,3.6 18.1,3 17.7,2.6 L15.4,0.3 C15,-0.1 14.4,-0.1 14,0.3 L12.2,2.1 L16,5.9 L17.7,4 L17.7,4 Z"
													id="Shape" />
											</g>
										</g>
									</g>
								</svg>
								<span>View</span>
							</a>

						</td>
					</tr>
                            `;
									$('.all-appointments').append(row);
								});
							} else {
								console.error(response.typeOf);
							}
						},
						error: function(xhr, status, error) {
							console.error(xhr.responseText);
						}
					});
				});
			});
