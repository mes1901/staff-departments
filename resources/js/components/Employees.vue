<template>
    <b-container fluid="md">
        <b-form-file
                class="mt-3 mb-3"
                v-model="file"
                :state="Boolean(file)"
                accept=".xml"
                placeholder="Choose your xml file or drop it here..."
                drop-placeholder="Drop xml file here..."
        ></b-form-file>
        <b-row class="p-2 mb-3">
            <b-col sm="2">
                <b-form-select
                        v-model="perPage"
                        :options="perPageOptions"
                ></b-form-select>
            </b-col>
            <b-col sm="2">
                <b-form-select
                        v-model="department"
                        :options="departmentOptions"
                ></b-form-select>
            </b-col>
            <b-col>
                <b-pagination v-if="employeesTotalRows"
                              class="justify-content-end m-0"
                              v-model="currentPage"
                              :total-rows="employeesTotalRows"
                              :per-page="perPage"
                ></b-pagination>
            </b-col>
        </b-row>
        <b-row>
            <b-table v-if="employeesTotalRows"
                     class="w-100"
                     id="employeeTable"
                     responsive
                     hover
                     selectable
                     :per-page="0"
                     :current-page="currentPage"
                     :items="employeesData"
                     :fields="visibleFields"
            >
            </b-table>
            <b-col class="text-center" v-else>
                <h3>There is no data</h3>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'

    export default {
        name: 'Employees',
        data () {
            return {
                file: null,
                currentPage: 1,
                perPage: 10,
                department: 0,
                fields: [
                    { key: 'id', label: 'id', visible: false },
                    { key: 'full_name', label: 'Full Name', visible: true },
                    { key: 'birthday', label: 'Birthday', visible: true },
                    { key: 'department', label: 'Department', visible: true },
                    { key: 'position', label: 'Position', visible: true },
                    { key: 'type', label: 'Type', visible: true },
                    { key: 'monthly_payment', label: 'Monthly Payment', visible: true },
                ],
                perPageOptions: [
                    { text: 10, value: 10 },
                    { text: 25, value: 25 },
                    { text: 50, value: 50 },
                    { text: 100, value: 100 },
                ],
            }
        },
        computed: {
            ...mapGetters([
                'employeesData',
                'employeesTotalRows',
                'departmentOptions',
            ]),
            visibleFields () {
                return this.fields.filter(field => field.visible)
            },
            compoundProperty () {
                return [this.currentPage, this.perPage, this.department].join()
            },
        },
        methods: {
            ...mapActions([
                'fetchEmployeesList',
                'fetchPageData',
                'fileUpload'
            ]),
            employeesFetchHandler () {
                this.fetchEmployeesList({
                    currentPage: this.currentPage,
                    perPage: this.perPage,
                    department: this.department,
                })
            },
            userFriendlyUrl () {
                if (this.department === 0) {
                    this.$router.push({ name: 'employees', query: { page: this.currentPage, perPage: this.perPage } })
                } else {
                    this.$router.push({
                        name: 'department',
                        params: { id: this.department },
                        query: { page: this.currentPage, perPage: this.perPage },
                    })
                }
            },
        },
        watch: {
            compoundProperty () {
                this.userFriendlyUrl()
                this.employeesFetchHandler()
            },
            file (value) {
                if (value) {
                    this.fileUpload(value)
                }
            },
        },
        created () {
            this.fetchPageData()
        },
    }
</script>

<style scoped>

</style>