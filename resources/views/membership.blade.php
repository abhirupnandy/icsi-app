<x-layouts.app>
	<x-slot:title>Join Us - {{ config('app.name') }}</x-slot:title>
	
	<div class="container mx-auto px-4 py-8 sm:py-12 max-w-6xl">
		<h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-center mb-6 sm:mb-8 text-gray-900 tracking-tight">
			Join Information and Communication Society of India
		</h1>
		
		<!-- Introduction Section -->
		<div class="bg-gray-50 p-4 sm:p-6 md:p-8 rounded-xl mb-6 sm:mb-8 shadow-sm">
			<p class="text-gray-700 text-base sm:text-lg leading-relaxed">
				Information and Communication Society of India (ICSI) is an all India professional body devoted to
				encouraging interaction among information and communication professionals, science communicators, social
				media managers, and users. The Society is truly professional in nature. It enrolls only qualified
				persons as members after applications have been screened and approved by the Membership Screening
				Committee, duly nominated by the Executive Committee.
			</p>
			<p class="text-gray-700 text-base sm:text-lg leading-relaxed mt-4 sm:mt-6">
				ICSI offers two types of memberships: Life Membership and Institutional Membership. Membership is open
				to graduates and professionals involved in activities relevant to ICSI. The membership of the society
				has been growing over the years.
			</p>
		</div>
		
		<div class="grid grid-cols-1 gap-6 sm:gap-8 md:grid-cols-2">
			<!-- Life Membership Section -->
			<div
				class="bg-white shadow-lg rounded-2xl p-4 sm:p-6 md:p-8 border border-gray-200 flex flex-col transition-all hover:shadow-xl"
			>
				<h2 class="text-xl sm:text-2xl md:text-3xl font-semibold text-gray-800 mb-3 sm:mb-4">Life
				                                                                                     Membership</h2>
				<p class="text-gray-600 text-sm sm:text-base md:text-lg flex-grow leading-relaxed">
					Life Membership is open to individuals who meet the qualification criteria. Members enjoy various
					benefits, including networking opportunities and access to ICSI resources.
				</p>
				<p class="text-base sm:text-lg md:text-xl font-semibold text-gray-800 mt-4 sm:mt-6">Membership Fee:
				                                                                                    ₹1,000/-</p>
				<p class="text-gray-600 text-sm sm:text-base md:text-lg">(Effective from January 2015)</p>
				<p class="text-gray-600 text-sm sm:text-base md:text-lg mt-3 sm:mt-4 leading-relaxed">
					One can remit the membership fee through online transfer (NEFT/IMPS) as per the given details.
				</p>
				<p class="text-gray-600 text-sm sm:text-base md:text-lg mt-3 sm:mt-4 leading-relaxed">
					Upload and send the filled application form along with the transfer receipt to <strong>icsi.president[at]gmail.com</strong>.
				</p>
				<a
					href="https://drive.google.com/file/d/0B6Kof6cxFVusaFJyTVlfZDIwLWpvSmpNcnZJYkV2d0RwYVJr/view?usp=sharing"
					target="_blank"
					class="inline-block px-4 py-2 sm:px-6 sm:py-3 mt-4 sm:mt-6 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200 self-start text-sm sm:text-base"
				>
					Download Application Form
				</a>
			</div>
			
			<!-- Institutional Membership Section -->
			<div
				class="bg-white shadow-lg rounded-2xl p-4 sm:p-6 md:p-8 border border-gray-200 flex flex-col transition-all hover:shadow-xl"
			>
				<h2 class="text-xl sm:text-2xl md:text-3xl font-semibold text-gray-800 mb-3 sm:mb-4">Institutional
				                                                                                     Membership</h2>
				<p class="text-gray-600 text-sm sm:text-base md:text-lg flex-grow leading-relaxed">
					Institutional Membership is available for organizations engaged in communications, knowledge, and
					information management. Institutions looking to collaborate with ICSI can apply.
				</p>
				<p class="text-base sm:text-lg md:text-xl font-semibold text-gray-800 mt-4 sm:mt-6">Membership Fee:
				                                                                                    ₹20,000/-</p>
				<p class="text-gray-600 text-sm sm:text-base md:text-lg mt-3 sm:mt-4 leading-relaxed">
					For further details and membership application, please contact us.
				</p>
				<a
					href="{{ route('contact') }}"
					class="inline-block px-4 py-2 sm:px-6 sm:py-3 mt-4 sm:mt-6 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 transition-colors duration-200 self-start text-sm sm:text-base"
				>
					Contact Us for Details
				</a>
			</div>
		</div>
		
		<!-- Payment Details Section -->
		<div class="mt-8 sm:mt-12 text-center">
			<h3 class="text-xl sm:text-2xl md:text-3xl font-semibold text-gray-800 mb-3 sm:mb-4">Payment Details</h3>
			<p class="text-base sm:text-lg md:text-xl text-gray-600">Remit the membership fee via online transfer:</p>
			<div class="bg-gray-50 p-4 sm:p-6 md:p-8 rounded-xl mt-4 inline-block text-left shadow-sm w-full sm:w-auto">
				<p class="text-base sm:text-lg md:text-xl text-gray-800"><strong>Name:</strong> Information and
				                                                                                Communication Society of
				                                                                                India</p>
				<p class="text-base sm:text-lg md:text-xl text-gray-800"><strong>Account No.:</strong> 1755000100180745
				</p>
				<p class="text-base sm:text-lg md:text-xl text-gray-800"><strong>IFSC:</strong> PUNB0175500</p>
			</div>
			<p class="text-base sm:text-lg md:text-xl text-gray-500 mt-4 sm:mt-6">
				Send your Application Form and Transfer Receipt to <strong>icsi.president[at]gmail.com</strong>
			</p>
		</div>
	</div>
</x-layouts.app>