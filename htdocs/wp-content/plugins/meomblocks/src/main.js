import { blocks } from '../meom-blocks.config.json';

blocks.forEach((block) => {
    require(`../blocks/${block.slug}/block.js`);
});
