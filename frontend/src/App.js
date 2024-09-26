import logo from './assets/logo.svg';
import './styles/App.css';
import { testFetch } from './services/apiService';

function App() {

  const handleButtonClick = async () => {
    try {
      const result = await testFetch('someType');
      console.log('API call successful:', result);
    } catch (error) {
      console.error('API call failed:', error.message);
    }
  };

  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        <button onClick={handleButtonClick}>
          Perform API call
        </button>
      </header>
    </div>
  );
}

export default App;
