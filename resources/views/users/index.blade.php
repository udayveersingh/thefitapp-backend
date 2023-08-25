<x-layout.default>
    <table id="users" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Refferal Code</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->refferal_code}}</td>   
            <td></td>
        </tr>
        @endforeach
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Refferal Code</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    {{-- <script src="{{asset('/assets/js/simple-datatables.js') }}"></script>
    <script src="{{asset('/assets/js/custom.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#users').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "{{ url('get-user') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {
                        _token: "{{ csrf_token() }}"
                    }
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "data": "refferal_code"
                    },
                    {
                        "data": "action"
                    }
                ]
            });
        });
    </script> --}}
    {{-- <script src="{{asset('/assets/js/simple-datatables.js') }}"></script>
    <div x-data="multipleTable">
        <div class="panel mt-6">
            <h5 class="md:absolute md:top-[25px] md:mb-0 mb-5 font-semibold text-lg dark:text-white-light">Users List</h5>
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
                            headings: ['Name','Email','Phone No.','Referal Code',
                                '<div class="text-center">Action</div>'
                            ],
                            data: [
                                ['Caroline Jensen','carolinejensen@zidant.com','+1 (821) 447-3782','123456',''],
                                ['Celeste Grant','celestegrant@polarax.com','+1 (838) 515-3408','12346',''],
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
                            },
                            {
                                select: 3,
                                render: (data, cell, row) => {
                                    return this.formatDate(data);
                                },
                            },
                            {
                                select: 6,
                                render: (data, cell, row) => {
                                    return '<span class="badge bg-' + this
                                    .randomColor() + '">' + this.randomStatus() +
                                        '</span>';
                                },
                            },
                            {
                                select: 7,
                                sortable: false,
                                render: (data, cell, row) => {
                                    return '<div class="text-center"><button type="button" x-tooltip="Delete"> <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"> <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5" /> <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" /> </svg> </button></div>';
                                },
                            }
                        ],
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

                formatDate(date) {
                    if (date) {
                        const dt = new Date(date);
                        const month = dt.getMonth() + 1 < 10 ? '0' + (dt.getMonth() + 1) : dt
                        .getMonth() + 1;
                        const day = dt.getDate() < 10 ? '0' + dt.getDate() : dt.getDate();
                        return day + '/' + month + '/' + dt.getFullYear();
                    }
                    return '';
                },

                randomColor() {
                    const color = ['primary', 'secondary', 'success', 'danger', 'warning', 'info'];
                    const random = Math.floor(Math.random() * color.length);
                    return color[random];
                },

                randomStatus() {
                    const status = ['PAID', 'APPROVED', 'FAILED', 'CANCEL', 'SUCCESS', 'PENDING','COMPLETE'
                    ];
                    const random = Math.floor(Math.random() * status.length);
                    return status[random];
                }
            }));
        });
    </script> --}}


</x-layout.default>
