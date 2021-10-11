/**
 * BLOCK: Tags Cloud
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import "./editor.scss";
import "./style.scss";

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
import {
	Flex,
	Card,
	FlexBlock,
	CardBody,
	TextareaControl,
	TextControl,
	Button,
} from "@wordpress/components";

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType("cgb/block-tags-cloud", {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __("Tags Cloud"), // Block title.
	icon: "text-page", // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: "common", // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__("my-blocks — CGB Block"),
		__("CGB Example"),
		__("create-guten-block"),
	],

	attributes: {
		tags: {
			type: "array",
			default: [
				{
					link: "",
					label: "",
				},
			],
		},
	},
	edit: ({ attributes, setAttributes }) => {
		function addTag() {
			setAttributes({
				tags: [
					...attributes.tags,
					{
						link: "",
						label: "",
					},
				],
			});
		}

		function updateItem(value, index, field) {
			const tags = [...attributes.tags];
			tags[index][field] = value;
			setAttributes({
				tags,
			});
		}

		function removeItem(index) {
			const tags = [...attributes.tags];
			tags.splice(index, 1);
			setAttributes({
				tags,
			});
		}
		return (
			<Card>
				{attributes.tags.map((item, index) => {
					return (
						<CardBody>
							<Flex>
								<FlexBlock>
									<TextControl
										label="Ссылка"
										value={item.link}
										onChange={(value) => updateItem(value, index, "link")}
									/>
								</FlexBlock>
								<FlexBlock>
									<TextControl
										label="Текст"
										value={item.label}
										onChange={(value) => updateItem(value, index, "label")}
									/>
								</FlexBlock>
								<FlexBlock>
									<Button onClick={() => removeItem(index)}>Удалить</Button>
								</FlexBlock>
							</Flex>
						</CardBody>
					);
				})}
				<CardBody>
					<Button onClick={addTag}>Добавить Таг</Button>
				</CardBody>
			</Card>
		);
	},

	save: (props) => {
		return null;
	},
});
