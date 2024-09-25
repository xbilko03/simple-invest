import logo from './assets/logo.svg';
import './styles/App.css';

function App() {
  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <button>
          Perform API call
        </button>
      </header>
    </div>
  );
}

export default App;
