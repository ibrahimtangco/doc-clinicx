@props([
    'resource'
])

<form action="{{ route('patients.search') }}" method="post" class="max-w-sm ">
    @csrf
							<div class="py-2">

								<div class="relative ">
									<input :type="text"
										class="text-md block px-2 py-1 rounded-md w-full
                                    bg-white border-2 border-gray-300 shadow-sm
                                    focus:bg-white
                                    focus:border-indigo-500
                                    focus:ring-indigo-500
                                    focus:outline-none"
									name="search">

									<div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
										<button type="submit" name="submit">
                                            <?xml version="1.0" ?><svg class="bi bi-eye-fill cursor-pointer fill-text-desc hover:fill-gray-600"
											fill="currentColor" height="24px" id="Layer_1" version="1.1" viewBox="0 0 512 512" width="24px"
											xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
											<path
												d="M344.5,298c15-23.6,23.8-51.6,23.8-81.7c0-84.1-68.1-152.3-152.1-152.3C132.1,64,64,132.2,64,216.3  c0,84.1,68.1,152.3,152.1,152.3c30.5,0,58.9-9,82.7-24.4l6.9-4.8L414.3,448l33.7-34.3L339.5,305.1L344.5,298z M301.4,131.2  c22.7,22.7,35.2,52.9,35.2,85c0,32.1-12.5,62.3-35.2,85c-22.7,22.7-52.9,35.2-85,35.2c-32.1,0-62.3-12.5-85-35.2  c-22.7-22.7-35.2-52.9-35.2-85c0-32.1,12.5-62.3,35.2-85c22.7-22.7,52.9-35.2,85-35.2C248.5,96,278.7,108.5,301.4,131.2z" />
										</svg>
                                        </button>
									</div>
								</div>
							</div>
						</form>
