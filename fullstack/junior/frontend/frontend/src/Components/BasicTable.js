import Table from 'react-bootstrap/Table';

import React, {Component} from 'react';

class BasicTable extends Component {

    constructor(props) {
        super(props);
        this.state = {
            data: null
        }

    }

    componentDidMount() {
        const formattedData = this.getFormattedData(this.props);
        this.setState({
            data: formattedData
        });
    }

    getFormattedData(props) {
        if (props.data == null)
            return null;

        const data = props.data;
        const formattedData = {};
        formattedData.columns = [];
        formattedData.rows = [];

        Object.keys(data[0]).map(key => formattedData.columns.push(key));
        Object.values(data).map(row => formattedData.rows.push(row));

        return formattedData;
    }

    render() {

        const tableHeaders = (
            <thead>
            <tr>
                {this.state.data && this.state.data.columns.map(column => {
                    return <th key={column}>{column}</th>;
                })}
            </tr>
            </thead>
        );

        const tableBody = (
            <tbody>
            {this.state.data && this.state.data.rows.map((row, index) => {
                return (
                    <tr key={index}>
                        {this.state.data.columns.map(column => {
                            return <td key={row[column] + index}>{row[column]}</td>;
                        })}
                    </tr>
                )
            })}
            </tbody>
        );

        return (
            <Table striped>
                {tableHeaders}
                {tableBody}
            </Table>
        )
    }
}

export default BasicTable;
