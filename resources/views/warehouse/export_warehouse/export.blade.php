@extends('master_layout.layout')

@section('styles')
@endsection

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Danh Sách Xuất Kho</span>
            </h3>

            <div class="card-toolbar">
                <a href="{{ route('warehouse.create_export') }}" class="btn btn-sm btn-twitter"><i class="fa fa-plus"></i>Tạo
                    Phiếu Xuất</a>
            </div>
        </div>

        <div class="card-body py-1">
            <form action="" class="row align-items-center">
                <div class="col-4">
                    <div class="row align-items-center">
                        <div class="col-5 pe-0">
                            <input type="date"
                                class="mt-2 mb-2 form-control form-control-sm form-control-solid border border-success"
                                value="{{ \Carbon\Carbon::now()->subMonths(3)->format('Y-m-d') }}">
                        </div>
                        <div class="col-2 text-center">
                            Đến
                        </div>
                        <div class="col-5 ps-0">
                            <input type="date"
                                class="mt-2 mb-2 form-control form-control-sm form-control-solid border border-success"
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <select name="ur" id="ur"
                        class="mt-2 mb-2 form-select form-select-sm form-select-solid border border-success setupSelect2">
                        <option value="" selected>--Theo Người Tạo--</option>
                        <option value="a">A</option>
                        <option value="b">B</option>
                    </select>
                </div>
                <div class="col-4 pe-8">
                    <div class="row">
                        <div class="col-10">
                            <input type="search" name="kw" placeholder="Tìm Kiếm Mã Phiếu Xuất.."
                                class="mt-2 mb-2 form-control form-control-sm form-control-solid border border-success"
                                value="{{ request()->kw }}">
                        </div>
                        <div class="col-2">
                            <button class="btn btn-dark btn-sm mt-2 mb-2" type="submit">Tìm</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body py-3">
            <div class="table-responsive">
                <table class="table table-striped align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bolder bg-success">
                            <th class="ps-4">Mã Phiếu Xuất</th>
                            <th class="">Người Tạo</th>
                            <th class="">Ngày Xuất</th>
                            <th class="">Lý Do Xuất</th>
                            <th class="">Trạng Thái</th>
                            <th class="pe-3">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 6; $i++)
                            <tr class="text-center">
                                <td>PX199001</td>
                                <td>Nhật Huy</td>
                                <td>26/08/2024</td>
                                <td>Xuất Bán Lẻ</td>
                                <td>
                                    @if ($i < 1)
                                        <span class="rounded px-2 py-1 text-white bg-danger">Chưa Duyệt</span>
                                    @else
                                        <span class="rounded px-2 py-1 text-white bg-success">Đã Duyệt</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" data-bs-toggle="dropdown">
                                            <i class="fa fa-ellipsis-h me-2"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#detailsModal">Chi tiết</a>
                                            </li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#browse">Duyệt đơn</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editExportReceiptModal">Chỉnh sửa</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Duyệt Phiếu --}}
    <div class="modal fade" id="browse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="browseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="browseLabel">Duyệt Phiếu Xuất Kho
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="">
                        @csrf
                        <h4 class="text-danger text-center">Duyệt Phiếu Xuất Kho Này?</h4>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-sm btn-twitter">Duyệt</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded">
                <!-- Modal header -->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal"
                        aria-label="Close">
                        X
                    </button>
                </div>
                <!-- Modal body -->
                <div id="printArea">
                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                        <form action="" method="post">
                            <div class="text-center mb-13">
                                <h1 class="mb-3">Phiếu Xuất</h1>
                                <div class="text-muted fw-bold fs-6">Thông Tin Chi Tiết Về Phiếu Xuất Kho
                                    <span class="link-primary fw-bolder">#MaXuatKho</span>.
                                </div>
                            </div>
                            <div class="mb-15">
                                <!-- Begin::Export Info -->
                                <div class="mb-4">
                                    <h4 class="text-primary border-bottom border-dark pb-4">Thông tin phiếu xuất</h4>
                                    <div class="row pt-3">
                                        <div class="col-4">
                                            <p><strong>Mã Phiếu Xuất:</strong> <span id="modalExportCode">PX00019</span>
                                            </p>
                                            <p><strong>Số Phiếu Xuất:</strong> <span id="modalExportNumber">025</span></p>
                                            <p><strong>Khách Hàng:</strong> <span id="modalCustomer">Nguyễn Văn A</span>
                                            </p>
                                            <p><strong>Ngày Xuất:</strong> <span id="modalExportDate">26/08/2024</span></p>
                                            <p><strong>Người Tạo:</strong> <span id="modalCreatedBy">Nhật Huy</span></p>
                                            <p><strong>Ghi Chú:</strong> <span id="modalNote">Hàng dễ vỡ</span></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End::Export Info -->

                                <!-- Begin::Export Items -->
                                <div class="mb-4">
                                    <h4 class="text-primary border-bottom border-dark pb-4 mb-4">Danh sách vật tư</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm table-hover">
                                            <thead class="fw-bolder bg-success">
                                                <tr>
                                                    <th class="ps-4">Mã vật tư</th>
                                                    <th>Số lượng</th>
                                                    <th>Đơn giá</th>
                                                    <th>Số lô</th>
                                                    <th>Chiết khấu (%)</th>
                                                    <th>VAT (%)</th>
                                                    <th class="pe-3">Tổng giá</th>
                                                </tr>
                                            </thead>
                                            <tbody id="modalItemsTableBody">
                                                <tr>
                                                    <td>VT001</td>
                                                    <td>10</td>
                                                    <td>50,000 VND</td>
                                                    <td>L001</td>
                                                    <td>5</td>
                                                    <td>10</td>
                                                    <td>55,000 VND</td>
                                                </tr>
                                                <tr>
                                                    <td>VT002</td>
                                                    <td>20</td>
                                                    <td>30,000 VND</td>
                                                    <td>L002</td>
                                                    <td>0</td>
                                                    <td>10</td>
                                                    <td>33,000 VND</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End::Export Items -->

                                <!-- Begin::Summary -->
                                <div class="card p-4" style="background-color: #e1e9f4; border: 1px solid #e3e3e3;">
                                    <h5 class="card-title">Tổng Cộng</h5>
                                    <hr>
                                    <p class="mb-1">Tổng Tiền Hàng:
                                        <span class="fw-bold" id="modalSubtotal">12.000.000 VND</span>
                                    </p>
                                    <p class="mb-1">Tổng Chiết Khấu:
                                        <span class="fw-bold" id="modalTotalDiscount">0 VND</span>
                                    </p>
                                    <p class="mb-1">Tổng VAT:
                                        <span class="fw-bold" id="modalTotalVat">0 VND</span>
                                    </p>
                                    <p class="mb-1">Chi Phí Vận Chuyển:
                                        <span class="fw-bold" id="modalShippingCost">0 VND</span>
                                    </p>
                                    <p class="mb-1">Phí Khác:
                                        <span class="fw-bold" id="modalOtherFees">0 VND</span>
                                    </p>
                                    <hr>
                                    <p class="fs-4 fw-bold text-success">Tổng:
                                        <span id="modalFinalTotal">12.000.000 VND</span>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between mt-5">
                                    <!-- Print Button -->
                                    <button type="button" id="printPdfBtn" class="btn btn-twitter btn-sm me-2">
                                        <i class="fa fa-print me-2"></i>In Phiếu
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Export Receipt Modal -->
    <div class="modal fade" id="editExportReceiptModal" tabindex="-1" aria-labelledby="editExportReceiptModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded">
                <!-- Modal Header -->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <h5 class="modal-title" id="editExportReceiptModalLabel">Chỉnh Sửa Phiếu Xuất</h5>
                    <button type="button" class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal"
                        aria-label="Close">
                        X
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <form action="" method="post">
                        <!-- Export Receipt Info -->
                        <div class="mb-5">
                            <h5 class="text-primary">Thông tin phiếu xuất</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="editExportCode" class="form-label">Mã Phiếu Xuất:</label>
                                        <input type="text" class="form-control" id="editExportCode" value="PX00019">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editExportNumber" class="form-label">Số Phiếu Xuất:</label>
                                        <input type="text" class="form-control" id="editExportNumber" value="025">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editCustomer" class="form-label">Khách Hàng:</label>
                                        <input type="text" class="form-control" id="editCustomer"
                                            value="Nguyễn Văn A">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="editExportDate" class="form-label">Ngày Xuất:</label>
                                        <input type="date" class="form-control" id="editExportDate"
                                            value="2024-08-26">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editCreatedBy" class="form-label">Người Tạo:</label>
                                        <input type="text" class="form-control" id="editCreatedBy" value="Nhật Huy">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editNote" class="form-label">Ghi Chú:</label>
                                        <textarea class="form-control" id="editNote" rows="2">Hàng dễ vỡ</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Receipt Items -->
                        <div class="mb-5">
                            <h5 class="text-primary">Danh sách vật tư</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Mã vật tư</th>
                                            <th>Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Số lô</th>
                                            <th>Chiết khấu (%)</th>
                                            <th>VAT (%)</th>
                                            <th>Tổng giá</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody id="editItemsTableBody">
                                        <tr>
                                            <td><input type="text" class="form-control" value="VT001"></td>
                                            <td><input type="number" class="form-control" value="10"></td>
                                            <td><input type="text" class="form-control" value="50,000 VND"></td>
                                            <td><input type="text" class="form-control" value="L001"></td>
                                            <td><input type="number" class="form-control" value="5"></td>
                                            <td><input type="number" class="form-control" value="10"></td>
                                            <td><input type="text" class="form-control" value="55,000 VND" readonly>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm">Xóa</button>
                                            </td>
                                        </tr>
                                        <!-- More rows as needed -->
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm">Thêm vật tư</button>
                        </div>

                        <!-- Summary -->
                        <div class="card p-3" style="background: #e1e9f4">
                            <h5 class="card-title">Tổng kết</h5>
                            <hr>
                            <p class="mb-1">Tổng tiền hàng:
                                <span class="fw-bold" id="editSubtotal">12.000.000 VND</span>
                            </p>
                            <p class="mb-1">Tổng chiết khấu:
                                <span class="fw-bold" id="editTotalDiscount">0 VND</span>
                            </p>
                            <p class="mb-1">Tổng VAT:
                                <span class="fw-bold" id="editTotalVat">0 VND</span>
                            </p>
                            <p class="mb-1">Chi phí vận chuyển:
                                <span class="fw-bold" id="editShippingCost">0 VND</span>
                            </p>
                            <p class="mb-1">Phí khác:
                                <span class="fw-bold" id="editOtherFees">0 VND</span>
                            </p>
                            <hr>
                            <p class="fs-4 fw-bold text-success">Tổng giá:
                                <span id="editFinalTotal">12.000.000 VND</span>
                            </p>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('printPdfBtn').addEventListener('click', function() {
            var printArea = document.getElementById('printArea').innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printArea;
            window.print();
            document.body.innerHTML = originalContent;
        });

        function openEditModal(code, number, customer, date, createdBy, note) {
            document.getElementById('editExportCode').value = code;
            document.getElementById('editExportNumber').value = number;
            document.getElementById('editCustomer').value = customer;
            document.getElementById('editExportDate').value = date;
            document.getElementById('editCreatedBy').value = createdBy;
            document.getElementById('editNote').value = note;

            var editExportReceiptModal = new bootstrap.Modal(document.getElementById('editExportReceiptModal'));
            editExportReceiptModal.show();
        }
    </script>
@endsection
