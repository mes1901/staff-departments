export default {
    getSpinner: (state) => {
        return state.spinner
    },
    employeesData: (state) => {
        return state.employeesReport.data
    },
    employeesTotalRows: (state) => {
        return state.employeesReport.totalRows
    },
    notification: (state) => {
        return state.notification
    },
    departmentOptions: (state) => {
        return state.departmentsOptions
    },
}