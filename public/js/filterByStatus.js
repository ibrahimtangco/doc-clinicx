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
                            ${appointment.service.name} a
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
								class="font-medium text-center text-white hover:bg-blue-700 bg-blue-600 px-2 py-1 rounded flex items-center justify-center gap-1 w-fit"
								href="${window.location.origin}/admin/edit-appointment/${appointment.id}">
								<svg width="15" height="15" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
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
