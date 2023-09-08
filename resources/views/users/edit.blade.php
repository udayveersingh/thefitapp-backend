<x-layout.default>

    @if (session()->has('message'))
        <div class="flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light mb-2">
            <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">
                </strong>{{ session()->get('message') }}</span>
            <button type="button" class="ltr:ml-auto rtl:mr-auto hover:opacity-80">
                <svg xmlns="" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>  
            </button>
        </div>
    @endif

    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Users</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Profile Settings</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="flex items-center justify-between mb-5">
                <h5 class="font-semibold text-lg dark:text-white-light">User Profile</h5>
            </div>
            <div x-data="{ tab: 'profile' }">
                <ul
                    class="sm:flex font-semibold border-b border-[#ebedf2] dark:border-[#191e3a] mb-5 whitespace-nowrap overflow-y-auto">
                    <li class="inline-block">
                        <a href="javascript:;"
                            class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary"
                            :class="{ '!border-primary text-primary': tab == 'profile' }" @click="tab='profile'">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="">
                                <circle cx="12" cy="6" r="4" stroke="currentColor"
                                    stroke-width="1.5" />
                                <path opacity="0.5" d="M18 9C19.6569 9 21 7.88071 21 6.5C21 5.11929 19.6569 4 18 4"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path opacity="0.5" d="M6 9C4.34315 9 3 7.88071 3 6.5C3 5.11929 4.34315 4 6 4"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <ellipse cx="12" cy="17" rx="6" ry="4"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M20 19C21.7542 18.6153 23 17.6411 23 16.5C23 15.3589 21.7542 14.3847 20 14"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path opacity="0.5"
                                    d="M4 19C2.24575 18.6153 1 17.6411 1 16.5C1 15.3589 2.24575 14.3847 4 14"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            Profile
                        </a>
                    </li>
                    {{-- <li class="inline-block">
                        <a href="javascript:;"
                            class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary"
                            :class="{ '!border-primary text-primary': tab == 'payment-details' }"
                            @click="tab='payment-details'">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                <circle opacity="0.5" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path d="M12 6V18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                <path
                                    d="M15 9.5C15 8.11929 13.6569 7 12 7C10.3431 7 9 8.11929 9 9.5C9 10.8807 10.3431 12 12 12C13.6569 12 15 13.1193 15 14.5C15 15.8807 13.6569 17 12 17C10.3431 17 9 15.8807 9 14.5"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            Payment Details
                        </a>
                    </li> --}}
                    {{-- <li class="inline-block">
                        <a href="javascript:;"
                            class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary"
                            :class="{ '!border-primary text-primary': tab == 'preferences' }"
                            @click="tab='preferences'">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                <circle cx="12" cy="6" r="4" stroke="currentColor"
                                    stroke-width="1.5" />
                                <ellipse opacity="0.5" cx="12" cy="17" rx="7" ry="4"
                                    stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            Preferences
                        </a>
                    </li> --}}
                    {{-- <li class="inline-block">
                        <a href="javascript:;"
                            class="flex gap-2 p-4 border-b border-transparent hover:border-primary hover:text-primary"
                            :class="{ '!border-primary text-primary': tab == 'danger-zone' }"
                            @click="tab='danger-zone'">

                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                <path
                                    d="M16.1007 13.359L16.5562 12.9062C17.1858 12.2801 18.1672 12.1515 18.9728 12.5894L20.8833 13.628C22.1102 14.2949 22.3806 15.9295 21.4217 16.883L20.0011 18.2954C19.6399 18.6546 19.1917 18.9171 18.6763 18.9651M4.00289 5.74561C3.96765 5.12559 4.25823 4.56668 4.69185 4.13552L6.26145 2.57483C7.13596 1.70529 8.61028 1.83992 9.37326 2.85908L10.6342 4.54348C11.2507 5.36691 11.1841 6.49484 10.4775 7.19738L10.1907 7.48257"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M18.6763 18.9651C17.0469 19.117 13.0622 18.9492 8.8154 14.7266C4.81076 10.7447 4.09308 7.33182 4.00293 5.74561"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path opacity="0.5"
                                    d="M16.1007 13.3589C16.1007 13.3589 15.0181 14.4353 12.0631 11.4971C9.10807 8.55886 10.1907 7.48242 10.1907 7.48242"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            Danger Zone
                        </a>
                    </li> --}}
                </ul>
                <template x-if="tab === 'profile'">
                    <div>
                        <form method="POST" action="{{ route('user.update', $user->id) }}"
                            class="border border-[#ebedf2] dark:border-[#191e3a] rounded-md p-4 mb-5 bg-white dark:bg-[#0e1726]">
                            @csrf
                            <h6 class="text-lg font-bold mb-5">Profile Information</h6>
                            <div class="flex flex-col sm:flex-row">
                                <div class="ltr:sm:mr-4 rtl:sm:ml-4 w-full sm:w-2/12 mb-5">
                                    @if (is_null($user->profile))
                                        <img src="{{ asset('/assets/images/profile.jpg') }}" alt="image"
                                            class="w-20 h-20 md:w-32 md:h-32 rounded-full object-cover mx-auto" />
                                    @else
                                        <img src="{{ asset('/storage/images/' . $user->profile->profile_pic) }}"
                                            alt="image"
                                            class="w-20 h-20 md:w-32 md:h-32 rounded-full object-cover mx-auto" />
                                    @endif
                                    {{-- <div x-data="modal">
                                        <!-- button -->
                                        <button type="button" class="btn btn-success mt-2" @click="toggle">Change Profile Photo</button>
                                        <!-- modal -->
                                        <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto"
                                            :class="open && '!block'">
                                            <div class="flex items-start justify-center min-h-screen px-4"
                                                @click.self="open = false">
                                                <div x-show="open" x-transition x-transition.duration.300
                                                    class="panel border-0 p-0 rounded-lg overflow-hidden w-11/12 sm:w-[300px] bg-secondary dark:bg-secondary my-8">
                                                    <div
                                                        class="flex items-center justify-end pt-4 ltr:pr-4 rtl:pl-4 text-white dark:text-white-light">
                                                        <button type="button" @click="toggle">
                                                            <svg> ... </svg>
                                                        </button>
                                                    </div>
                                                    <div class="p-5">
                                                        <div class="py-5 text-white dark:text-white-light text-center">
                                                            <div
                                                                class="rounded-full w-20 h-20 mx-auto mb-7 overflow-hidden">
                                                                <img src="/assets/images/profile-16.jpeg" alt="image"
                                                                    class="w-full h-full object-cover" />
                                                            </div>
                                                            <p class="font-semibold">Click on view to access <br>your
                                                                profile.</p>
                                                        </div>
                                                        <div class="flex justify-center gap-4 p-5">
                                                            <button type="button"
                                                                class="btn bg-white text-black dark:btn-dark">View</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <input type="text" placeholder="Some Text..." class="form-input" required /> --}}
                                </div>
                                <!-- profile -->
                                <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label for="name">Name</label>
                                        <input id="name" type="text" placeholder="" class="form-input"
                                            value="{{ $user->name }}" name="name" />
                                    </div>
                                    <div>
                                        <label for="phone">Phone</label>
                                        <input id="phone" type="text" placeholder="" class="form-input"
                                            value="{{ $user->phone }}" name="phone" />
                                    </div>
                                    <div>
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-input"
                                            value="{{ $user->email }}" name="email" />
                                    </div>
                                    {{-- <div>
                                        <label for="referral_code">Referral Code</label>
                                        <input id="referral_code" type="text" placeholder="" class="form-input"
                                            value="{{ $user->referral_code }}" />
                                    </div> --}}
                                    <div class="sm:col-span-2 mt-3">
                                        <button type="submit" value="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </template>
                <template x-if="tab === 'payment-details'">
                    <div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
                            <div class="panel">
                                <div class="mb-5">
                                    <h5 class="font-semibold text-lg mb-4">Billing Address</h5>
                                    <p>Changes to your <span class="text-primary">Billing</span> information will take
                                        effect starting with scheduled payment and will be refelected on your next
                                        invoice.</p>
                                </div>
                                <div class="mb-5">
                                    <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                        <div class="flex items-start justify-between py-3">
                                            <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                Address #1 <span
                                                    class="block text-white-dark dark:text-white-light font-normal text-xs mt-1">2249
                                                    Caynor Circle, New Brunswick, New Jersey</span></h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                        <div class="flex items-start justify-between py-3">
                                            <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                Address #2 <span
                                                    class="block text-white-dark dark:text-white-light font-normal text-xs mt-1">4262
                                                    Leverton Cove Road, Springfield, Massachusetts</span></h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-start justify-between py-3">
                                            <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                Address #3 <span
                                                    class="block text-white-dark dark:text-white-light font-normal text-xs mt-1">2692
                                                    Berkshire Circle, Knoxville, Tennessee</span></h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary">Add Address</button>
                            </div>
                            <div class="panel">
                                <div class="mb-5">
                                    <h5 class="font-semibold text-lg mb-4">Payment History</h5>
                                    <p>Changes to your <span class="text-primary">Payment Method</span> information
                                        will take effect starting with scheduled payment and will be refelected on your
                                        next invoice.</p>
                                </div>
                                <div class="mb-5">
                                    <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                        <div class="flex items-start justify-between py-3">
                                            <div class="flex-none ltr:mr-4 rtl:ml-4">
                                                <img src="/assets/images/card-americanexpress.svg" alt="image" />
                                            </div>
                                            <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                Mastercard <span
                                                    class="block text-white-dark dark:text-white-light font-normal text-xs mt-1">XXXX
                                                    XXXX XXXX 9704</span></h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-b border-[#ebedf2] dark:border-[#1b2e4b]">
                                        <div class="flex items-start justify-between py-3">
                                            <div class="flex-none ltr:mr-4 rtl:ml-4">
                                                <img src="/assets/images/card-mastercard.svg" alt="image" />
                                            </div>
                                            <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                American Express<span
                                                    class="block text-white-dark dark:text-white-light font-normal text-xs mt-1">XXXX
                                                    XXXX XXXX 310</span></h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-start justify-between py-3">
                                            <div class="flex-none ltr:mr-4 rtl:ml-4">
                                                <img src="/assets/images/card-visa.svg" alt="image" />
                                            </div>
                                            <h6 class="text-[#515365] font-bold dark:text-white-dark text-[15px]">
                                                Visa<span
                                                    class="block text-white-dark dark:text-white-light font-normal text-xs mt-1">XXXX
                                                    XXXX XXXX 5264</span></h6>
                                            <div class="flex items-start justify-between ltr:ml-auto rtl:mr-auto">
                                                <button class="btn btn-dark">Edit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary">Add Payment Method</button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                            <div class="panel">
                                <div class="mb-5">
                                    <h5 class="font-semibold text-lg mb-4">Add Billing Address</h5>
                                    <p>Changes your New <span class="text-primary">Billing</span> Information.</p>
                                </div>
                                <div class="mb-5">
                                    <form>
                                        <div class="mb-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label for="billingName">Name</label>
                                                <input id="billingName" type="text" placeholder="Enter Name"
                                                    class="form-input" />
                                            </div>
                                            <div>
                                                <label for="billingEmail">Email</label>
                                                <input id="billingEmail" type="email" placeholder="Enter Email"
                                                    class="form-input" />
                                            </div>
                                        </div>
                                        <div class="mb-5">
                                            <label for="billingAddress">Address</label>
                                            <input id="billingAddress" type="text" placeholder="Enter Address"
                                                class="form-input" />
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-5">
                                            <div class="md:col-span-2">
                                                <label for="billingCity">City</label>
                                                <input id="billingCity" type="text" placeholder="Enter City"
                                                    class="form-input" />
                                            </div>
                                            <div>
                                                <label for="billingState">State</label>
                                                <select id="billingState" class="form-select text-white-dark">
                                                    <option>Choose...</option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="billingZip">Zip</label>
                                                <input id="billingZip" type="text" placeholder="Enter Zip"
                                                    class="form-input" />
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary">Add</button>
                                    </form>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="mb-5">
                                    <h5 class="font-semibold text-lg mb-4">Add Payment Method</h5>
                                    <p>Changes your New <span class="text-primary">Payment Method</span> Information.
                                    </p>
                                </div>
                                <div class="mb-5">
                                    <form>
                                        <div class="mb-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label for="payBrand">Card Brand</label>
                                                <select id="payBrand" class="form-select text-white-dark">
                                                    <option selected="">Mastercard</option>
                                                    <option>American Express</option>
                                                    <option>Visa</option>
                                                    <option>Discover</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="payNumber">Card Number</label>
                                                <input id="payNumber" type="text" placeholder="Card Number"
                                                    class="form-input" />
                                            </div>
                                        </div>
                                        <div class="mb-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label for="payHolder">Holder Name</label>
                                                <input id="payHolder" type="text" placeholder="Holder Name"
                                                    class="form-input" />
                                            </div>
                                            <div>
                                                <label for="payCvv">CVV/CVV2</label>
                                                <input id="payCvv" type="text" placeholder="CVV"
                                                    class="form-input" />
                                            </div>
                                        </div>
                                        <div class="mb-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div>
                                                <label for="payExp">Card Expiry</label>
                                                <input id="payExp" type="text" placeholder="Card Expiry"
                                                    class="form-input" />
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
                <template x-if="tab === 'preferences'">
                    <div class="switch">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Choose Theme</h5>
                                <div class="flex justify-around">
                                    <label class="inline-flex cursor-pointer">
                                        <input class="form-radio ltr:mr-4 rtl:ml-4 cursor-pointer" type="radio"
                                            name="flexRadioDefault" checked="" />
                                        <span>
                                            <img class="ms-3" width="100" height="68" alt="settings-dark"
                                                src="/assets/images/settings-light.svg" />
                                        </span>
                                    </label>

                                    <label class="inline-flex cursor-pointer">
                                        <input class="form-radio ltr:mr-4 rtl:ml-4 cursor-pointer" type="radio"
                                            name="flexRadioDefault" />
                                        <span>
                                            <img class="ms-3" width="100" height="68" alt="settings-light"
                                                src="/assets/images/settings-dark.svg" />
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Activity data</h5>
                                <p>Download your Summary, Task and Payment History Data</p>
                                <button type="button" class="btn btn-primary">Download Data</button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Public Profile</h5>
                                <p>Your <span class="text-primary">Profile</span> will be visible to anyone on the
                                    network.</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox1" />
                                    <span for="custom_switch_checkbox1"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Show my email</h5>
                                <p>Your <span class="text-primary">Email</span> will be visible to anyone on the
                                    network.</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox2" />
                                    <span for="custom_switch_checkbox2"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white  dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Enable keyboard shortcuts</h5>
                                <p>When enabled, press <span class="text-primary">ctrl</span> for help</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox3" />
                                    <span for="custom_switch_checkbox3"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white  dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Hide left navigation</h5>
                                <p>Sidebar will be <span class="text-primary">hidden</span> by default</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox4" />
                                    <span for="custom_switch_checkbox4"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white  dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Advertisements</h5>
                                <p>Display <span class="text-primary">Ads</span> on your dashboard</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox5" />
                                    <span for="custom_switch_checkbox5"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white  dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Social Profile</h5>
                                <p>Enable your <span class="text-primary">social</span> profiles on this network</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox6" />
                                    <span for="custom_switch_checkbox6"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white  dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </template>
                <template x-if="tab === 'danger-zone'">
                    <div class="switch">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Purge Cache</h5>
                                <p>Remove the active resource from the cache without waiting for the predetermined cache
                                    expiry time.</p>
                                <button class="btn btn-secondary">Clear</button>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Deactivate Account</h5>
                                <p>You will not be able to receive messages, notifications for up to 24 hours.</p>
                                <label class="w-12 h-6 relative">
                                    <input type="checkbox"
                                        class="custom_switch absolute w-full h-full opacity-0 z-10 cursor-pointer peer"
                                        id="custom_switch_checkbox7" />
                                    <span for="custom_switch_checkbox7"
                                        class="bg-[#ebedf2] dark:bg-dark block h-full rounded-full before:absolute before:left-1 before:bg-white dark:before:bg-white-dark dark:peer-checked:before:bg-white before:bottom-1 before:w-4 before:h-4 before:rounded-full peer-checked:before:left-7 peer-checked:bg-primary before:transition-all before:duration-300"></span>
                                </label>
                            </div>
                            <div class="panel space-y-5">
                                <h5 class="font-semibold text-lg mb-4">Delete Account</h5>
                                <p>Once you delete the account, there is no going back. Please be certain.</p>
                                <button class="btn btn-danger btn-delete-account">Delete my account</button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

</x-layout.default>
