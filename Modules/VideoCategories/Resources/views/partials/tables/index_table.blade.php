<template v-if="!preloader">

    <div v-if="rows.data.length > 0">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th>#</th>
                    <th>Categoría</th>
                    <th>Alta</th>
                    <th></th>
                </tr>

            </thead>

            <tbody>
                        
                <tr v-for="row in rows.data">
                    
                    <th scope="row" v-text="row.id"></th>

                    <td><a v-text="row.name" class="dropdown-item" :href="editUrl + row.id"></a></td>

                    <td v-text="row.created_at"></td>

                    <td style="text-align:center;">

                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Acciones
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" :href="editUrl + row.id">{{ trans('app.edit') }}</a>
                                <a style="cursor: pointer;" class="dropdown-item" @click="confirmationDialog('{{ trans('app.confirmDelete') }}',deleteUrl + row.id)">{{ trans('app.delete') }}</a>
                            </div>
                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

        <ul class="pagination float-right">
            
            <li v-if="rows.prev_page_url != null" @click="getDataByPage(rows.current_page - 1)" class="page-item"><a class="page-link"><span aria-hidden="true">«</span></a></li>

            <li v-if="rows.last_page > 1" v-for="page in rows.last_page" @click="getDataByPage(page)" :key="page" class="page-item" :class="{'active': (rows.current_page == page)}"><a v-text="page" class="page-link"></a></li>

            <li v-if="rows.next_page_url != null" @click="getDataByPage(rows.current_page + 1)" class="page-item"><a class="page-link"><span aria-hidden="true">»</span></a></li>

        </ul>

    </div>

    <span v-else class="d-flex align-items-center purchase-popup col-12">

        {!! trans('app.noDataShow') !!}
       
    </span>


</template>