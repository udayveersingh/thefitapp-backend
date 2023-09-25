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
    <div x-data="usersWithdrawlList">
        <script src="{{ asset('/assets/js/simple-datatables.js') }}"></script>
        <div class="panel px-0 border-[#e0e6ed] dark:border-[#1b2e4b]">
            <div class="px-5">
                <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">WithDrawl List
                </h5>
            </div>
            <div class="step-trackers-Table">
                <table id="usersWithdrawlTable" class="whitespace-nowrap"></table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("usersWithdrawlList", () => ({
                datatable1: null,
                init() {
                    this.datatable1 = new simpleDatatables.DataTable('#usersWithdrawlTable', {
                        data: {
                            headings: ['Name','Transaction Type', 'Transaction Date',
                                'Earning'
                            ],
                            data: [
                                @foreach ($users_withdrawl as $withdrawl)
                                    ['{{ $withdrawl->name }}',
                                        '{{ $withdrawl->transaction_type }}',
                                        '{{ $withdrawl->date }}',
                                        '{{ $withdrawl->debit_amount }}'
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
                                return `<div class="flex items-center w-max">${data}</div>`;
                            },
                            sort: "asc"
                        }, ],
                        firstLast: true,
                        firstText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        lastText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M11 19L17 12L11 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path opacity="0.5" d="M6.99976 19L12.9998 12L6.99976 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        prevText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M15 5L9 12L15 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        nextText: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" class="w-4.5 h-4.5 rtl:rotate-180"> <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>',
                        labels: {
                            perPage: "{select}"
                        },
                        layout: {
                            top: "{search}",
                            bottom: "{info}{select}{pager}",
                        },
                    });
                },
            }));
        });
    </script>
</x-layout.default>
