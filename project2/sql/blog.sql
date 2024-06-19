-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 12:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `first_name`, `last_name`) VALUES
(3, '10x', 'Developer');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(8, 'frameworks');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `content` varchar(4096) NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `date`, `content`, `author`) VALUES
(5, 'The Evolution of JavaScript Frameworks: From jQuery to Modern Frameworks', '2024-05-13', 'Introduction\r\n\r\nJavaScript frameworks have revolutionized web development, providing developers with tools to create dynamic and responsive applications. This journey, from the early days of jQuery to the sophisticated frameworks we use today, reflects the evolving needs and innovations in web development. In this blog post, we\'ll explore the milestones in the evolution of JavaScript frameworks and their impact on the web development landscape.\r\nThe Rise of jQuery\r\n\r\nIn the mid-2000s, jQuery emerged as a game-changer, simplifying JavaScript for developers. Before jQuery, manipulating the DOM and handling cross-browser issues were cumbersome tasks. jQuery provided a simple and consistent API that made these tasks easier, fostering a more interactive and user-friendly web.\r\n\r\nKey Features of jQuery:\r\n\r\n    Simplified DOM manipulation.\r\n    Cross-browser compatibility.\r\n    Event handling and animation support.\r\n    AJAX integration for asynchronous web applications.\r\n\r\nAngularJS: The Game Changer\r\n\r\nIn 2010, Google introduced AngularJS, marking a significant shift in how web applications were developed. AngularJS was a full-fledged MVC (Model-View-Controller) framework that allowed developers to build single-page applications (SPAs) with a clean separation of concerns.\r\n\r\nImpact of AngularJS:\r\n\r\n    Two-way data binding for automatic synchronization between model and view.\r\n    Dependency injection for better code organization and testing.\r\n    Directives for extending HTML capabilities.\r\n    Enhanced performance for complex applications.\r\n\r\nReact: A Paradigm Shift\r\n\r\nFacebook\'s introduction of React in 2013 brought a new paradigm to front-end development. React focused on building user interfaces using a component-based architecture and introduced the concept of a virtual DOM, which efficiently updates the UI in response to data changes.\r\n\r\nKey Contributions of React:\r\n\r\n    Component-based architecture for reusable and maintainable code.\r\n    Virtual DOM for high performance.\r\n    Unidirectional data flow for predictable state management.\r\n    Ecosystem of tools and libraries, including React Native for mobile app development.\r\n\r\nVue.js: The Progressive Framework\r\n\r\nVue.js, created by Evan You in 2014, offered a progressive approach to building user interfaces. Vue.js gained popularity for its simplicity and flexibility, making it easy for developers to integrate it into existing projects or build complex applications from scratch.\r\n\r\nHighlights of Vue.js:\r\n\r\n    Incremental adoption, allowing use as a library or a full framework.\r\n    Reactive data binding and composable components.\r\n    User-friendly and intuitive API.\r\n    Strong community support and comprehensive documentation.\r\n\r\nSvelte: The New Kid on the Block\r\n\r\nSvelte, introduced by Rich Harris in 2016, brought a fresh perspective to JavaScript frameworks by shifting the work to compile time rather than runtime. This approach eliminates the need for a virtual DOM and results in highly optimized and smaller output files.\r\n\r\nInnovations of Svelte:\r\n\r\n    Compile-time optimization for faster performance.\r\n    Simplicity in syntax and structure.\r\n    Reactive declarations for concise and clear code.\r\n    Direct manipulation of the DOM for better performance.\r\n\r\nConclusion\r\n\r\nThe evolution of JavaScript frameworks reflects the dynamic nature of web development. From jQuery\'s simplicity to AngularJS\'s structure, React\'s innovation, Vue.js\'s flexibility, and Svelte\'s optimization, each framework has contributed to advancing the capabilities of web applications. As we look to the future, staying updated with these frameworks and their developments will be crucial for building efficient, scalable, and responsive web applications.\r\n\r\nBy understanding the history and evolution of JavaScript frameworks, developers can make informed decisions about which tools best suit their project needs and contribute to the ever-growing landscape of web development.', 3),
(6, 'React vs. Angular vs. Vue: A Detailed Comparison', '2024-05-14', 'Introduction\r\n\r\nChoosing the right JavaScript framework can be a daunting task for developers given the variety of options available today. React, Angular, and Vue are three of the most popular frameworks, each with its own strengths and use cases. In this blog post, we will compare React, Angular, and Vue in detail to help you decide which one is best for your next project.\r\nCore Philosophy and Design\r\n\r\nReact:\r\nReact, developed by Facebook, is a library for building user interfaces. It emphasizes a component-based architecture and focuses on the \"View\" in the MVC (Model-View-Controller) framework. React uses a virtual DOM to optimize updates and provides a unidirectional data flow, which makes it easier to reason about the state of the application.\r\n\r\nAngular:\r\nAngular, maintained by Google, is a full-fledged framework that follows the MVC architecture. Angular is a comprehensive solution for building large-scale applications with a strong emphasis on structured and maintainable code. It uses two-way data binding, which automatically synchronizes data between the model and the view.\r\n\r\nVue:\r\nVue, created by Evan You, is often described as a progressive framework. It is designed to be incrementally adoptable, meaning you can use it as a library to enhance parts of an application or as a full-fledged framework. Vue combines the best features of both React and Angular, offering a flexible and approachable solution.\r\nPerformance and Speed\r\n\r\nReact:\r\nReact\'s use of a virtual DOM improves performance by minimizing direct DOM manipulations. This makes React applications generally fast, especially for applications with frequent updates and complex UIs.\r\n\r\nAngular:\r\nAngular uses real DOM but mitigates performance issues with techniques like change detection and zone.js. However, its performance can be slower compared to React due to the overhead of its extensive features.\r\n\r\nVue:\r\nVue also uses a virtual DOM, which allows for fast updates and rendering. Its performance is comparable to React and generally better than Angular due to its lighter framework and optimized reactivity system.\r\nLearning Curve\r\n\r\nReact:\r\nReact has a moderate learning curve. Its core concepts like components, JSX, and state management are straightforward, but mastering React often requires learning additional libraries such as Redux for state management and React Router for routing.\r\n\r\nAngular:\r\nAngular has a steep learning curve due to its comprehensive nature. It requires learning TypeScript, its own template syntax, dependency injection, and other concepts that are unique to Angular. However, once mastered, Angular provides a powerful toolset for building large applications.\r\n\r\nVue:\r\nVue has a gentle learning curve. Its syntax is simple and intuitive, making it easy for beginners to get started. Vue\'s documentation is extensive and clear, which helps new developers quickly become productive.\r\nEcosystem and Tooling\r\n\r\nReact:\r\nReact has a vast ecosystem with a rich selection of libraries and tools. The flexibility of React allows developers to choose their own libraries for state management, routing, and other functionalities. The downside is that it can lead to decision fatigue when selecting the best tools for your project.\r\n\r\nAngular:\r\nAngular comes with a robust set of built-in tools and features, including Angular CLI, Angular Material, and a comprehensive testing framework. This integrated approach provides a cohesive development experience but can be less flexible compared to React\'s ecosystem.\r\n\r\nVue:\r\nVue offers a well-balanced ecosystem with official libraries for state management (Vuex) and routing (Vue Router). It also has a powerful CLI tool that simplifies project setup and management. Vue’s ecosystem strikes a balance between flexibility and ease of use.\r\nReal-World Use Cases\r\n\r\nReact:\r\n\r\n    Facebook and Instagram: Large-scale applications with complex UIs.\r\n    Airbnb: Highly interactive user interfaces.\r\n    Netflix: Dynamic and responsive user experiences.\r\n\r\nAngular:\r\n\r\n    Google: Many internal tools and applications.\r\n    Microsoft', 3),
(7, 'Getting Started with Svelte: A Beginner’s Guide', '2024-05-15', 'Introduction\r\n\r\nSvelte is an innovative JavaScript framework that offers a unique approach to building web applications. Unlike traditional frameworks, Svelte shifts the work from runtime to compile time, resulting in highly optimized, faster, and smaller applications. In this beginner’s guide, we\'ll walk through the basics of Svelte and how to get started with building your first Svelte application.\r\nWhy Choose Svelte?\r\n\r\nSvelte stands out from other frameworks due to its novel approach to UI development. Here are some reasons why you might choose Svelte for your next project:\r\n\r\n    No Virtual DOM: Svelte compiles your components into efficient, imperative code that directly manipulates the DOM.\r\n    Reactive Declarations: Svelte\'s reactivity system is simple and intuitive, making state management straightforward.\r\n    Smaller Bundle Sizes: The compilation process produces smaller bundles, leading to faster load times.\r\n    Ease of Learning: Svelte\'s syntax and structure are easy to grasp, making it a great choice for beginners.\r\n\r\nSetting Up Your Environment\r\n\r\nBefore we dive into building a Svelte app, let\'s set up the development environment.\r\n\r\n    Install Node.js and npm:\r\n    Make sure you have Node.js and npm installed. You can download them from the official Node.js website.\r\n\r\n    Create a New Svelte Project:\r\n    Use the Svelte template to quickly set up a new project. Open your terminal and run:\r\n\r\n    bash\r\n\r\nnpx degit sveltejs/template my-svelte-app\r\ncd my-svelte-app\r\nnpm install\r\n\r\nStart the Development Server:\r\nTo start the development server, run:\r\n\r\nbash\r\n\r\n    npm run dev\r\n\r\n    Open your browser and navigate to http://localhost:5000. You should see the Svelte welcome message.\r\n\r\nBasic Concepts\r\n\r\nComponents and Props:\r\nIn Svelte, everything is a component. Components are self-contained pieces of UI that can accept input data via props.\r\n\r\nExample of a basic Svelte component:\r\n\r\nhtml\r\n\r\n<script>\r\n  export let name = \'world\';\r\n</script>\r\n\r\n<main>\r\n  <h1>Hello {name}!</h1>\r\n</main>\r\n\r\n<style>\r\n  h1 {\r\n    color: purple;\r\n  }\r\n</style>\r\n\r\nReactive Declarations:\r\nSvelte\'s reactivity system allows you to declare reactive variables using the $: syntax.\r\n\r\nExample of a reactive declaration:\r\n\r\nhtml\r\n\r\n<script>\r\n  let count = 0;\r\n  $: doubled = count * 2;\r\n</script>\r\n\r\n<button on:click={() => count += 1}>\r\n  Count: {count} (Doubled: {doubled})\r\n</button>\r\n\r\nBuilding Your First Svelte App\r\n\r\nLet\'s build a simple counter app to demonstrate the basic features of Svelte.\r\n\r\n    Create a New Component:\r\n    Create a file named Counter.svelte in the src directory.\r\n\r\nhtml\r\n\r\n<!-- src/Counter.svelte -->\r\n<script>\r\n  let count = 0;\r\n\r\n  function increment() {\r\n    count += 1;\r\n  }\r\n\r\n  function decrement() {\r\n    count -= 1;\r\n  }\r\n</script>\r\n\r\n<main>\r\n  <h1>Counter: {count}</h1>\r\n  <button on:click={increment}>Increment</button>\r\n  <button on:click={decrement}>Decrement</button>\r\n</main>\r\n\r\n<style>\r\n  main {\r\n    text-align: center;\r\n    padding: 1em;\r\n    margin: 2em;\r\n    border: 2px solid #ccc;\r\n    border-radius: 8px;\r\n  }\r\n\r\n  button {\r\n    margin: 0.5em;\r\n    padding: 0.5em 1em;\r\n    font-size: 1em;\r\n  }\r\n</style>\r\n\r\n    Use the Component in the Main App:\r\n    Open App.svelte and import the Counter component.\r\n\r\nhtml\r\n\r\n<!-- src/App.svelte -->\r\n<script>\r\n  import Counter from \'./Counter.svelte\';\r\n</script>\r\n\r\n<main>\r\n  <h1>Welcome to Svelte</h1>\r\n  <Counter />\r\n</main>\r\n\r\n<style>\r\n  main {\r\n    text-align: center;\r\n    padding: 1em;\r\n    max-width: 240px;\r\n    margin: 0 auto;\r\n  }\r\n</style>\r\n\r\n    Run Your Application:\r\n    Save your files and ensure the development server is running (npm run dev). Open your browser and navigate to http://localhost:5000. You should see your counter app in action.\r\n\r\nAdvanced Features\r\n\r\nTransitions and Animations:\r\nSvelte provides built-in support for transitions and animations, making it easy to add visual effects to your components.\r\n\r\nExample of a simple transition:\r\n\r\nhtml\r\n\r\n<script>\r\n  import { fade } from \'svelte/transition\';\r\n\r\n  let visible = true;\r\n</script>\r\n\r\n<butto', 3),
(8, 'State Management in Vue: Vuex Explained', '2024-05-16', 'Introduction\r\n\r\nState management is crucial in developing large-scale applications where multiple components need to share and synchronize state. Vue.js, known for its simplicity and flexibility, offers a powerful state management library called Vuex. In this blog post, we will explore the core concepts of Vuex and how to use it to manage state in your Vue applications.\r\nWhy Use Vuex?\r\n\r\nAs your application grows, managing shared state across components can become complex. Here are some reasons to use Vuex:\r\n\r\n    Centralized State Management: Vuex provides a single source of truth for the application\'s state.\r\n    Predictable State Mutations: State can only be mutated in a predictable manner through mutations.\r\n    Debugging and Testing: Vuex\'s strict structure makes debugging and testing easier.\r\n    DevTools Integration: Vuex integrates seamlessly with Vue DevTools, offering powerful debugging capabilities.\r\n\r\nCore Concepts of Vuex\r\n\r\nVuex is built around several core concepts: State, Getters, Mutations, Actions, and Modules. Let’s break down each of these concepts.\r\n\r\nState:\r\nThe state is a single object that contains the application\'s data. It is the central repository of information.\r\n\r\nExample:\r\n\r\njavascript\r\n\r\nconst state = {\r\n  count: 0\r\n};\r\n\r\nGetters:\r\nGetters are computed properties that return derived state based on the store\'s state. They can be used to filter or calculate data from the state.\r\n\r\nExample:\r\n\r\njavascript\r\n\r\nconst getters = {\r\n  doubleCount: state => state.count * 2\r\n};\r\n\r\nMutations:\r\nMutations are the only way to change the state in Vuex. They must be synchronous and are typically used to make straightforward changes to the state.\r\n\r\nExample:\r\n\r\njavascript\r\n\r\nconst mutations = {\r\n  increment(state) {\r\n    state.count++;\r\n  }\r\n};\r\n\r\nActions:\r\nActions are similar to mutations but can be asynchronous. They commit mutations and can contain arbitrary asynchronous operations.\r\n\r\nExample:\r\n\r\njavascript\r\n\r\nconst actions = {\r\n  incrementAsync({ commit }) {\r\n    setTimeout(() => {\r\n      commit(\'increment\');\r\n    }, 1000);\r\n  }\r\n};\r\n\r\nModules:\r\nModules allow you to divide the store into multiple modules, each with its own state, mutations, actions, and getters. This is useful for large applications.\r\n\r\nExample:\r\n\r\njavascript\r\n\r\nconst moduleA = {\r\n  state: { /* ... */ },\r\n  mutations: { /* ... */ },\r\n  actions: { /* ... */ },\r\n  getters: { /* ... */ }\r\n};\r\n\r\nconst store = new Vuex.Store({\r\n  modules: {\r\n    a: moduleA\r\n  }\r\n});\r\n\r\nSetting Up Vuex in a Vue Project\r\n\r\nTo use Vuex in your Vue project, you need to install it and integrate it with your Vue instance.\r\n\r\n    Install Vuex:\r\n\r\n    bash\r\n\r\n    npm install vuex@next --save\r\n\r\n    Create a Store:\r\n    Create a store.js file to define your store.\r\n\r\njavascript\r\n\r\nimport { createStore } from \'vuex\';\r\n\r\nconst store = createStore({\r\n  state: {\r\n    count: 0\r\n  },\r\n  getters: {\r\n    doubleCount: state => state.count * 2\r\n  },\r\n  mutations: {\r\n    increment(state) {\r\n      state.count++;\r\n    }\r\n  },\r\n  actions: {\r\n    incrementAsync({ commit }) {\r\n      setTimeout(() => {\r\n        commit(\'increment\');\r\n      }, 1000);\r\n    }\r\n  }\r\n});\r\n\r\nexport default store;\r\n\r\n    Integrate the Store with Vue:\r\n    In your main application file (main.js), import the store and add it to your Vue instance.\r\n\r\njavascript\r\n\r\nimport { createApp } from \'vue\';\r\nimport App from \'./App.vue\';\r\nimport store from \'./store\';\r\n\r\ncreateApp(App)\r\n  .use(store)\r\n  .mount(\'#app\');\r\n\r\nWorking with State and Getters\r\n\r\nState and getters provide reactive data that your components can use.\r\n\r\nAccessing State:\r\nYou can access the state directly from your components using this.$store.state.\r\n\r\nExample in a component:\r\n\r\njavascript\r\n\r\n<template>\r\n  <div>{{ $store.state.count }}</div>\r\n</template>\r\n\r\nUsing Getters:\r\nAccess getters through this.$store.getters.\r\n\r\nExample in a component:\r\n\r\njavascript\r\n\r\n<template>\r\n  <div>{{ $store.getters.doubleCount }}</div>\r\n</template>\r\n\r\nMutations and Actions\r\n\r\nMutations and actions are essential for modifying the state.\r\n\r\nCommitting Mutations:\r\nTo change', 3),
(9, 'The Future of JavaScript Frameworks: Trends and Predictions', '2024-05-17', 'Introduction\n\nJavaScript frameworks have been at the forefront of web development for years, continuously evolving to meet the demands of developers and users alike. As we look to the future, several trends and innovations are shaping the next generation of JavaScript frameworks. In this blog post, we will explore these trends and make predictions about the future of JavaScript frameworks.\nKey Trends Shaping the Future\n\n1. Performance Optimization:\n\nPerformance remains a critical concern for web applications. Future JavaScript frameworks will continue to prioritize performance optimization through techniques like server-side rendering (SSR), static site generation (SSG), and efficient state management. The goal is to reduce load times, improve responsiveness, and enhance the user experience.\n\n2. Improved Developer Experience:\n\nFrameworks will increasingly focus on improving the developer experience. This includes better tooling, comprehensive documentation, and streamlined development workflows. Frameworks like Svelte have already made strides in this area by reducing boilerplate code and simplifying the syntax.\n\n3. TypeScript Adoption:\n\nTypeScript\'s popularity is on the rise, and future JavaScript frameworks are expected to embrace TypeScript more fully. TypeScript\'s static typing and enhanced tooling capabilities help catch errors early and improve code quality, making it an attractive choice for developers.\n\n4. Micro-Frontends:\n\nThe micro-frontend architecture allows teams to develop, deploy, and scale different parts of a web application independently. Future frameworks will likely offer built-in support for micro-frontend architectures, enabling more modular and scalable applications.\n\n5. Progressive Web Apps (PWAs):\n\nPWAs provide a native app-like experience on the web, and future JavaScript frameworks will continue to enhance support for PWA features. This includes better offline capabilities, push notifications, and improved performance on mobile devices.\nEmerging Frameworks and Innovations\n\n1. Svelte:\n\nSvelte has gained significant traction due to its innovative approach of compiling components at build time, resulting in highly optimized and performant applications. Its simplicity and ease of learning make it a strong contender for future adoption.\n\n2. SolidJS:\n\nSolidJS is an emerging framework that emphasizes fine-grained reactivity and high performance. It offers a modern approach to building user interfaces with a focus on efficiency and simplicity, making it an exciting framework to watch.\n\n3. Qwik:\n\nQwik introduces a new concept called \"resumability,\" which aims to eliminate the need for client-side hydration. By serializing the application state on the server and resuming it on the client, Qwik promises faster load times and better performance.\n\n4. Lit:\n\nLit, developed by Google, is a lightweight framework for building web components. It focuses on simplicity, performance, and compatibility with modern web standards. Lit\'s small footprint and ease of use make it an attractive option for developers looking to build web components.\nPredictions for the Future\n\n1. Increased Focus on WebAssembly:\n\nWebAssembly (Wasm) allows high-performance code to run in the browser, opening up new possibilities for JavaScript frameworks. Future frameworks will likely leverage WebAssembly to offload compute-intensive tasks, resulting in faster and more efficient applications.\n\n2. Enhanced AI and Machine Learning Integration:\n\nAs AI and machine learning continue to advance, JavaScript frameworks will integrate these technologies more seamlessly. This could include built-in support for AI-driven features like personalized content, natural language processing, and predictive analytics.\n\n3. Greater Emphasis on Security:\n\nWith the increasing number of cyber threats, security will be a top priority for future JavaScript frameworks. Expect to see enhanced security features, better tooling for identifying vulnerabilities, and frameworks designed with security best practices in mind.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `post_category_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`post_category_id`, `post_id`, `category_id`) VALUES
(8, 5, 8),
(9, 6, 8),
(10, 7, 8),
(11, 8, 8),
(12, 9, 8);

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_tag_id`, `post_id`, `tag_id`) VALUES
(15, 5, 15),
(16, 5, 10),
(17, 5, 11),
(18, 5, 12),
(19, 5, 13),
(20, 5, 14),
(21, 6, 12),
(22, 6, 11),
(23, 6, 13),
(24, 7, 17),
(25, 7, 14),
(26, 8, 17),
(27, 8, 13),
(28, 9, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `tag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `tag`) VALUES
(10, 'jquery'),
(11, 'angular'),
(12, 'react'),
(13, 'vue'),
(14, 'svelte'),
(15, 'history'),
(16, 'future'),
(17, 'tutorial');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`post_category_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`post_tag_id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `post_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `post_tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
