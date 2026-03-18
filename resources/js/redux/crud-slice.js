import { createSlice } from "@reduxjs/toolkit";

export const crudSlice = createSlice({
    name: "crud",
    initialState: {
        form: null,
        filterQuery: null,
        table: null,
        deleteModal: {
            endpoint: null,
            elementId: null,
        }
    },
    reducers: {
        setForm: (state, action) => {
            state.form = action.payload;
        },
        setFilterQuery: (state, action) => {
            state.filterQuery = action.payload;
        },
        setTable: (state, action) => {
            state.table = action.payload;
        },
        setDeleteModal: (state, action) => {
            state.deleteModal = action.payload;
        },
    },
});

export const { setForm, setFilterQuery, setTable, setDeleteModal } = crudSlice.actions;
export default crudSlice.reducer;