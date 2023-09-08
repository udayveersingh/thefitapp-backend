<x-layout.default>
<style>
    .dataTable-container {
    overflow: visible;
}
</style>
    <script src="{{ asset('/assets/js/simple-datatables.js') }}"></script>
    @if (session()->has('message'))
        <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light mb-2">
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
    <div x-data="multipleTable">
        <div class="panel mt-6">
            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Users List
            </h5>
            <table id="userTable" class="whitespace-nowrap">
            </table>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("multipleTable", () => ({
                datatable1: null,
                init() {
                    this.datatable1 = new simpleDatatables.DataTable('#userTable', {
                        data: {
                            headings: ['Name', 'Email', 'Phone', 'Referral Code', 'Action'],
                            data: [
                                @foreach ($users as $user)
                                    ['<a href="{{ route('user.detail', $user->id) }}" class="text-primary hover:underline">{{ $user->name }}</a>',
                                        '{{ $user->email }}', '{{ $user->phone }}',
                                        '{{ $user->referral_code }}',
                                        `<div class="flex items-center justify-center"><div x-data="dropdown" @click.outside="open = false" class="dropdown"><button
                                         class="btn p-0 rounded-none border-0 shadow-none dropdown-toggle text-black dark:text-white-dark hover:text-primary dark:hover:text-primary"
                                         @click="toggle"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="" class="w-6 h-6 opacity-70">
                                         <circle cx="5" cy="12" r="2"
                                         stroke="currentColor" stroke-width="1.5"></circle>
                                         <circle opacity="0.5" cx="12" cy="12" r="2"
                                         stroke="currentColor" stroke-width="1.5"></circle>
                                         <circle cx="19" cy="12" r="2"
                                         stroke="currentColor" stroke-width="1.5"></circle>
                                         </svg></button>
                                         <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                            class="ltr:right-0 rtl:left-0 bottom-full !mt-0 mb-1 whitespace-nowrap">
                                            <li><a href="{{route('users.edit',$user->id)}}" @click="toggle">User Edit</a></li>
                                            <li><a href="javascript:;" @click="toggle">User Tracker</a></li>
                                            <li><a href="javascript:;" @click="toggle">User Earning</a></li>    
                                         </ul>
                                    </div>
                                </div>`,        
                                ],
                                @endforeach
                            ]
                        },
                        searchable: true,
                        perPage: 10,
                        perPageSelect: [10, 20, 30, 50, 100],
                        columns: [{
                            select: 0,
                            render: (data, cell, row) => {
                                return `<div class="flex items-center w-max"><a href="">${data}</a></div>`;
                            },
                            sort: "asc"
                        }, ],
                        firstLast: true,
                        firstText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        lastText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        prevText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        nextText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        labels: {
                            perPage: "{select}"
                        },
                        layout: {
                            top: "{search}",
                            bottom: "{info}{select}{pager}",
                        },
                    });
                },

                // formatDate(date) {
                //     if (date) {
                //         const dt = new Date(date);
                //         const month = dt.getMonth() + 1 < 10 ? '0' + (dt.getMonth() + 1) : dt
                //         .getMonth() + 1;
                //         const day = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
                //         return day + '/' + month + '/' + dt.getFullYear();
                //     }
                //     return '';
                // },

                // randomColor() {
                //     const color = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
                //     const random = Math.floor(Math.random() * color.length);
                //     return color[random];
                // },

                // randomStatus() {
                //     const status = ['PAID', 'APPROVED', 'FAILED', 'CANCEL', 'SUCCESS', 'PENDING','COMPLETE'
                //     ];
                //     const random = Math.floor(Math.random() * status.length);
                //     return status[random];
                // }
            }));
        });
        </script>


</x-layout.default>
