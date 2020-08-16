import React from "react";
import ReactDOM from "react-dom";

const App = () => {
    return <p>表示されてる？</p>;
};

export default App;

if (document.getElementById("test")) {
    ReactDOM.render(<App />, document.getElementById("test"));
}
