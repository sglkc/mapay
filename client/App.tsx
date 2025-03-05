import { LocationProvider, Router, Route } from 'preact-iso';
import { Header } from './components/Header.jsx';
import { NotFound } from './pages/_404.jsx';
import HomePage from './pages/Home.js';

export function App() {
	return (
		<LocationProvider>
			<Header />
			<main>
				<Router>
					<Route path="/" component={HomePage} />
					<Route default component={NotFound} />
				</Router>
			</main>
		</LocationProvider>
	);
}
