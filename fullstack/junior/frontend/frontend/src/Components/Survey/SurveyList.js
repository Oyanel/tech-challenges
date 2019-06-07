import React, {Component} from 'react';
import BasicTable from '../BasicTable';
import SurveyController from '../../Controller/SurveyController';

class SurveyList extends Component {

    constructor(props) {
        super(props);
        this.surveyController = new SurveyController();
        this.state = {
            surveys: null,
            surveysFormatted: []
        }
    }

    componentDidMount() {
        this.surveys();
    }

    async surveys() {
        let surveys = await this.surveyController.getList();
        this.setState({
            surveys: surveys
        });
    }

    render() {
        return (
            <div className="survey-list">
                {this.state.surveys && <BasicTable data={this.state.surveys}/>}
            </div>
        );
    }
}

export default SurveyList;
