import React from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'

class SearchItems extends Component {
    constructor(props) {
        super(props)
        this.state = {
            keyrowd: ''
        }
        this.onChangeValue = this.onChangeValue.bind(this)
        this.onSubmitButton = this.onSubmitButton.bind(this)
    }

    onSubmitButton(e) {
        e.preventDefault()

        axios.post('/searchItems', {
            keyword: this.state.keyword
        })
            .then(function (response) {
                console.log(response.data)
            })
            .catch(function (error) {
                console.log(error)
            })

        this.setState({
            keyrowd: ''
        })
    }

    componentDidMount() {
    }
    render() {
        return (
            <div className="col-12 p-0" >
                <React.StrictMode>
                    <form onSubmit={this.onSubmitButton} className="form-inline">
                        <input type="search"
                            name="keyword"
                            placeholder="キーワードを入力"
                            className="form-control col-8 ml-0"
                            value={this.state.name}
                            onChange={this.onChangeValue}
                            required autoComplete="on" />
                        <button className="btn btn-outline-success ml-2"
                            type="submit">
                            <i className="fas fa-search"></i>
                        </button>
                    </form>
                </React.StrictMode>
            </div>
        )
    }

}
export default SearchItems

if (document.getElementById('searchItems')) {
    ReactDOM.render(<SearchItems />, document.getElementById('searchItems'))
}
